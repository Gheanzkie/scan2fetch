<?php

namespace App\Controllers;

use App\Models\ParentsModel;
use App\Models\SubFetcherModel;
use App\Models\ActivityLogModel;

class Parents extends BaseController
{
    protected $parentsModel;
    protected $subFetcherModel;
    protected $logModel;

    public function __construct()
    {
        if (!session('logged_in')) {
            return redirect()->to('/login')->send();
        }
        $this->parentsModel    = new ParentsModel();
        $this->subFetcherModel = new SubFetcherModel();
        $this->logModel        = new ActivityLogModel();
    }

    public function index()
    {
        helper('photo');
        // Full parent directory = admin only. The parent role gets the
        // self-service pages (releases / notifications / logs / children),
        // never the list of EVERY parent in the school.
        if (session('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Access denied: parent directory is admin only.');
        }

        $db = \Config\Database::connect();

        // One row per parent (a parent may have several children). The old
        // join returned a separate row per child, so multi-child parents were
        // listed more than once and only ever showed one student per row.
        $parents = $db->table('parents')
            ->orderBy('created_at', 'DESC')
            ->get()
            ->getResultArray();

        $links = $db->table('student_parents')
            ->select('student_parents.parent_id, student_parents.relation,
                      students.id AS student_id, students.fname, students.lname,
                      students.grade_section')
            ->join('students', 'students.id = student_parents.student_id')
            ->orderBy('students.lname', 'ASC')
            ->get()
            ->getResultArray();

        $byParent = [];
        foreach ($links as $l) {
            $byParent[$l['parent_id']][] = $l;
        }

        foreach ($parents as &$p) {
            $kids = $byParent[$p['id']] ?? [];
            $p['children']    = $kids;
            $p['child_count'] = count($kids);
            // Single-value aliases kept for the existing view template.
            $p['student_fname'] = $kids[0]['fname']       ?? null;
            $p['student_lname'] = $kids[0]['lname']       ?? null;
            $p['student_grade'] = $kids[0]['grade_section'] ?? null;
            $p['relation']      = $kids[0]['relation']    ?? null;
        }
        unset($p);

        $data['parents'] = $parents;

        return view('parents', $data);
    }

    public function view($id)
    {
        helper('photo');
        // Ownership: a logged-in parent may only open their OWN record.
        if (session('role') === 'parent' && (int) session('user_id') !== (int) $id) {
            return redirect()->to('/parents-view/' . session('user_id'))->with('error', 'You can only view your own profile.');
        }

        $data['parent'] = $this->parentsModel->find($id);
        if (!$data['parent']) {
            return redirect()->to('/parents')->with('error', 'Parent not found');
        }

        $db = \Config\Database::connect();
        
        $data['students'] = $db->table('student_parents')
            ->select('student_parents.*, students.fname, students.mname, students.lname, students.grade_section, students.id as student_id')
            ->join('students', 'students.id = student_parents.student_id')
            ->where('student_parents.parent_id', $id)
            ->get()
            ->getResultArray();

        $teachers = $db->table('teachers')->get()->getResultArray();
        $teacherMap = [];
        foreach ($teachers as $t) {
            if (!isset($teacherMap[$t['grade_section']])) {
                $teacherMap[$t['grade_section']] = $t['fname'] . ' ' . $t['lname'];
            }
        }
        $data['teacherMap'] = $teacherMap;

        $data['subFetchers'] = $this->subFetcherModel->where('parent_id', $id)->findAll();

        return view('parents_view', $data);
    }

    public function save()
    {
        if (session('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Access denied.');
        }
        $qrValue = $this->generateQR();

        $this->parentsModel->save([
            'fname' => $this->request->getPost('fname'),
            'mname' => $this->request->getPost('mname'),
            'lname' => $this->request->getPost('lname'),
            'phone' => $this->request->getPost('phone'),
            'password' => null,
            'password_sent' => 0,
            'qr_code' => $qrValue,
            'created_by' => session('user_id'),
        ]);
        $this->logModel->addLog(
            session('user_id'),
            session('fname') . ' ' . session('lname'),
            session('role'),
            'create',
            'parent',
            'Created parent: ' . $this->request->getPost('fname') . ' ' . $this->request->getPost('lname')
        );

        $msg = 'Parent added';
        return redirect()->to('/parents')->with('msg', $msg);
    }

    // ===== SEND / RESET PASSWORD VIA SMS =====
    public function sendPassword($id)
    {
        if (! $this->requireAdminStaff()) return;
        $parent = $this->parentsModel->find($id);
        if (!$parent) {
            return redirect()->to('/parents')->with('error', 'Parent not found');
        }

        $this->deliverPassword($this->parentsModel, $parent, 'parent');

        $this->logModel->addLog(
            session('user_id'),
            session('fname') . ' ' . session('lname'),
            session('role'),
            'update',
            'parent',
            'Reset password and sent via SMS for parent: ' . $parent['fname'] . ' ' . $parent['lname'] . ' (ID: ' . $id . ')'
        );

        $msg = 'New password recorded in SMS logs.';
        return redirect()->to('/parents-view/' . $id)->with('msg', $msg);
    }

    // ===== SEND PASSWORD TO ALL PARENTS NOT YET SENT =====
    public function sendAllPasswords()
    {
        if (! $this->requireAdminStaff()) return;
        $pending = $this->parentsModel->where('password_sent', 0)->findAll();
        $sent = 0;
        foreach ($pending as $parent) {
            $this->deliverPassword($this->parentsModel, $parent, 'parent');
            $sent++;
        }

        $this->logModel->addLog(
            session('user_id'),
            session('fname') . ' ' . session('lname'),
            session('role'),
            'update',
            'parent',
            "Sent passwords to $sent parent(s) who had not received one yet."
        );

        return redirect()->to('/parents')->with('msg', "Passwords sent to $sent parent(s).");
    }

    public function update()
    {
        $id = (int) $this->request->getPost('id');
        $role = session('role');

        // IDOR fix: admin may edit anyone; a parent may ONLY edit themself,
        // and may never set a password here (passwords change via
        // change-password which re-verifies the current one).
        if ($role !== 'admin') {
            if ($role !== 'parent' || $id !== (int) session('user_id')) {
                return redirect()->to('/dashboard')->with('error', 'Access denied.');
            }
        }

        $data = [
            'fname' => $this->request->getPost('fname'),
            'mname' => $this->request->getPost('mname'),
            'lname' => $this->request->getPost('lname'),
            'phone' => $this->request->getPost('phone')
        ];
        if ($role === 'admin' && $this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }
        $__newParentNo = strtoupper(trim((string) $this->request->getPost('parent_no')));
        if ($__newParentNo !== '') {
            $__oldParent = $this->parentsModel->find($id);
            if (!$__oldParent || $__newParentNo !== strtoupper((string) ($__oldParent['parent_no'] ?? ''))) {
                if ($this->parentsModel->where('parent_no', $__newParentNo)->where('id !=', $id)->countAllResults() > 0) {
                    return redirect()->to('/parents')->with('error', 'Parent ID ' . $__newParentNo . ' is already taken.');
                }
                $data['parent_no'] = $__newParentNo;
            }
        }

        $this->parentsModel->update($id, $data);

        if (!empty($__oldParent) && isset($data['parent_no'])) {
            $__from = uploads_path('parents') . strtoupper((string) ($__oldParent['parent_no'] ?? '')) . '.jpg';
            $__to   = uploads_path('parents') . strtoupper((string) $data['parent_no']) . '.jpg';
            if (is_file($__from)) { @copy($__from, $__to); }
        }

        // Profile picture (edit modal): save new image or remove the old one.
        $parentNo = (string) ($this->parentsModel->find($id)["parent_no"] ?? "");
        if ($parentNo !== "") {
            helper("photo");
            $pic = (string) $this->request->getPost("parent_picture_data");
            if ($pic !== "") {
                photo_save_parent_dataurl($pic, $parentNo);
            } elseif ($this->request->getPost("parent_picture_remove") === "1") {
                parent_photo_delete($parentNo);
            }
        }
        $this->logModel->addLog(
            session('user_id'),
            session('fname') . ' ' . session('lname'),
            session('role'),
            'update',
            'parent',
            'Updated parent: ' . $data['fname'] . ' ' . $data['lname'] . ' (ID: ' . $id . ')'
        );
        return redirect()->to('/parents')->with('msg', 'Parent updated');
    }

    // ========== DELETE ALL PARENTS (ADMIN ONLY) ==========
    public function deleteAll()
    {
        if (session('role') != 'admin') {
            return redirect()->to('/parents')->with('error', 'Admin only.');
        }

        $db = \Config\Database::connect();
        $db->transStart();

        try {
            $count = $this->parentsModel->countAllResults();

            // DELETE, never TRUNCATE. MySQL refuses to TRUNCATE a table that
            // is referenced by a foreign key, which is why this used to die
            // with "Cannot truncate a table referenced in a foreign key
            // constraint (... fk_fetchlogs_parent ...)" and roll back.
            // Children must go first. wipeTable() runs a bare DELETE FROM,
            // which honours ON DELETE CASCADE / SET NULL on every FK.
            $this->wipeTable('fetch_logs');
            $this->wipeTable('sub_fetchers');
            $this->wipeTable('student_parents');

            $studentCount = $db->table('students')->countAllResults();
            $this->wipeTable('students');

            $this->wipeTable('parents');

            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \Exception('Transaction failed');
            }

            $this->logModel->addLog(
                session('user_id'), session('fname') . ' ' . session('lname'), session('role'),
                'delete', 'parent',
                "DELETED ALL parents ($count) with linked students ($studentCount), sub-fetchers and logs"
            );

            return redirect()->to('/parents')->with('msg', "All $count parent(s) deleted. $studentCount orphaned student(s) also removed.");
        } catch (\Exception $e) {
            $db->transRollback();
            log_message('error', 'Delete all parents failed: ' . $e->getMessage());
            return redirect()->to('/parents')->with('error', 'Delete all failed: ' . $e->getMessage());
        }
    }

    // ========== DELETE PARENT (With Student Deletion) ==========
    public function delete($id)
    {
        // Cascade delete of a parent + their students = admin only.
        if (session('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Access denied: only admin can delete parents.');
        }
        $db = \Config\Database::connect();
        $parent = $this->parentsModel->find($id);
        
        if (!$parent) {
            return redirect()->to('/parents')->with('error', 'Parent not found');
        }

        $db->transStart();

        try {
            // 1. Get all students linked to this parent
            $studentLinks = $db->table('student_parents')
                ->where('parent_id', $id)
                ->get()
                ->getResultArray();

            $studentIds = array_column($studentLinks, 'student_id');

            // 2. Delete sub-fetchers linked to this parent
            $db->table('sub_fetchers')->where('parent_id', $id)->delete();

            // 3. Delete student_parents links
            $db->table('student_parents')->where('parent_id', $id)->delete();

            // 4. Delete the parent
            $this->parentsModel->delete($id);

            // 5. Delete students with no parents left
            $deletedStudents = [];
            foreach ($studentIds as $studentId) {
                $remainingParents = $db->table('student_parents')
                    ->where('student_id', $studentId)
                    ->countAllResults();

                if ($remainingParents == 0) {
                    $student = $db->table('students')
                        ->where('id', $studentId)
                        ->get()
                        ->getRowArray();
                    
                    if ($student) {
                        $db->table('fetch_logs')->where('student_id', $studentId)->delete();
                        $db->table('students')->where('id', $studentId)->delete();
                        $deletedStudents[] = $student['fname'] . ' ' . $student['lname'];
                    }
                }
            }

            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \Exception('Transaction failed');
            }

            $message = 'Parent: ' . $parent['fname'] . ' ' . $parent['lname'] . ' deleted successfully! 🗑️';
            if (!empty($deletedStudents)) {
                $message .= ' Student(s) deleted (no other parents): ' . implode(', ', $deletedStudents);
            }

            $this->logModel->addLog(
                session('user_id'),
                session('fname') . ' ' . session('lname'),
                session('role'),
                'delete',
                'parent',
                'Deleted parent: ' . $parent['fname'] . ' ' . $parent['lname'] . ' (ID: ' . $id . ') with sub-fetchers. Students deleted: ' . implode(', ', $deletedStudents)
            );

            return redirect()->to('/parents')->with('msg', $message);

        } catch (\Exception $e) {
            $db->transRollback();
            log_message('error', 'Delete parent failed: ' . $e->getMessage());
            return redirect()->to('/parents')->with('error', 'Delete failed: ' . $e->getMessage());
        }
    }

    public function updatePicture()
    {
        return redirect()->to('/parents')->with('error', 'Photo upload is disabled');
    }

    public function updateFromStudent()
    {
        // Admin-only: this endpoint rewrites a parent record (incl. password)
        // from the student form. Parents/teachers must never reach it.
        if (session('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Access denied.');
        }
        $id = $this->request->getPost('id');
        $studentId = $this->request->getPost('student_id');
        $data = [
            'fname' => $this->request->getPost('fname'),
            'mname' => $this->request->getPost('mname'),
            'lname' => $this->request->getPost('lname'),
            'phone' => $this->request->getPost('phone')
        ];
        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }
        $this->parentsModel->update($id, $data);
        $this->logModel->addLog(
            session('user_id'),
            session('fname') . ' ' . session('lname'),
            session('role'),
            'update',
            'parent',
            'Updated parent: ' . $data['fname'] . ' ' . $data['lname'] . ' (ID: ' . $id . ')'
        );
        return redirect()->to('/students-view/' . $studentId)->with('msg', 'Parent updated');
    }

    // ===== RELEASE HISTORY =====
    public function releases()
    {
        $userId = session('user_id');
        $studentModel = new \App\Models\StudentModel();
        $db = \Config\Database::connect();

        // Date filter: defaults to all
        $selectedDate = $this->request->getGet('date') ?? '';
        if ($selectedDate && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $selectedDate)) {
            $selectedDate = '';
        }

        // Search filter
        $search = trim($this->request->getGet('q') ?? '');
        
        $studentParents = $db->table('student_parents')
            ->where('parent_id', $userId)
            ->get()
            ->getResultArray();
        
        $studentIds = [];
        foreach ($studentParents as $sp) {
            $studentIds[] = $sp['student_id'];
        }
        
        $subFetchers = $this->subFetcherModel->where('parent_id', $userId)->findAll();
        foreach ($subFetchers as $sf) {
            $studentIds[] = $sf['student_id'];
        }
        
        $studentIds = array_unique($studentIds);
        
        $data['releases'] = [];
        if (!empty($studentIds)) {
            $fetchLogModel = new \App\Models\FetchLogModel();
            $query = $fetchLogModel
                ->select('fetch_logs.*, students.fname AS sfname, students.mname AS smname, students.lname AS slname, students.grade_section')
                ->join('students', 'students.id = fetch_logs.student_id', 'left')
                ->whereIn('fetch_logs.student_id', $studentIds);

            if ($selectedDate) {
                $query->where('DATE(fetch_logs.time_released)', $selectedDate);
            }

            $releases = $query
                ->orderBy('time_released', 'DESC')
                ->limit(100)
                ->findAll();

            foreach ($releases as &$release) {
                $release['action'] = 'release';
            }
            $data['releases'] = $releases;
        }

        // Only releases (pending/released). Declined state removed per project rule.
        $allLogs = array_values($data['releases']);

        // Search filter
        if ($search !== '') {
            $allLogs = array_filter($allLogs, function($r) use ($search) {
                $haystack = strtolower(
                    ($r['sfname'] ?? '') . ' ' .
                    ($r['smname'] ?? '') . ' ' .
                    ($r['slname'] ?? '') . ' ' .
                    full_name($r, 'fetcher_')
                );
                return strpos($haystack, strtolower($search)) !== false;
            });
            $allLogs = array_values($allLogs);
        }

        $data['logs'] = $allLogs;
        $data['selectedDate'] = $selectedDate;
        $data['search'] = $search;
        
        return view('parents_releases', $data);
    }

    // ===== SMS NOTIFICATIONS =====
    public function notifications()
    {
        $db = \Config\Database::connect();
        $parentPhone = session('phone');
        $data['smsNotifications'] = [];
        
        if (!empty($parentPhone)) {
            $smsLogs = $db->table('sms_logs')
                ->select('sms_logs.*')
                ->where('parent_phone', $parentPhone)
                ->orderBy('sent_at', 'DESC')
                ->limit(50)
                ->get()
                ->getResultArray();
            
            foreach ($smsLogs as &$log) {
                $message = $log['message'] ?? '';
                $log['student_fname'] = 'Unknown';
                $log['student_lname'] = '';
                $log['grade_section'] = '';
                
                if (preg_match('/child\s+([^\s]+)\s+([^\s]+)/i', $message, $matches)) {
                    $log['student_fname'] = $matches[1];
                    $log['student_lname'] = $matches[2] ?? '';
                } elseif (preg_match('/for\s+([^\s]+)\s+([^\s]+)/i', $message, $matches)) {
                    $log['student_fname'] = $matches[1];
                    $log['student_lname'] = $matches[2] ?? '';
                } elseif (preg_match('/Your\s+child\s+([^\s]+)\s+([^\s]+)/i', $message, $matches)) {
                    $log['student_fname'] = $matches[1];
                    $log['student_lname'] = $matches[2] ?? '';
                } elseif (preg_match('/Student:\s*([^\s]+)\s*([^\s]+)/i', $message, $matches)) {
                    $log['student_fname'] = $matches[1];
                    $log['student_lname'] = $matches[2] ?? '';
                }
            }
            $data['smsNotifications'] = $smsLogs;
        }
        
        return view('parents_notifications', $data);
    }

    // ===== DELETE OWN SMS NOTIFICATION =====
    public function deleteNotification($id)
    {
        $db = \Config\Database::connect();
        $parentPhone = session('phone');

        if (empty($parentPhone)) {
            return redirect()->to('/parents-notifications')->with('error', 'No phone number linked to your account.');
        }

        $deleted = $db->table('sms_logs')
            ->where('id', $id)
            ->where('parent_phone', $parentPhone)
            ->delete();

        if ($deleted) {
            $this->logModel->addLog(session('user_id'), session('fname').' '.session('lname'), session('role'), 'delete', 'sms_notification', 'Deleted SMS notification (ID: '.$id.')');
            return redirect()->to('/parents-notifications')->with('msg', 'SMS notification deleted.');
        }
        return redirect()->to('/parents-notifications')->with('error', 'Notification not found. You can only delete your own notifications.');
    }

    // ===== CLEAR ALL OWN SMS NOTIFICATIONS =====
    public function clearAllNotifications()
    {
        $db = \Config\Database::connect();
        $parentPhone = session('phone');

        if (empty($parentPhone)) {
            return redirect()->to('/parents-notifications')->with('error', 'No phone number linked to your account.');
        }

        $deleted = $db->table('sms_logs')->where('parent_phone', $parentPhone)->delete();
        $this->logModel->addLog(session('user_id'), session('fname').' '.session('lname'), session('role'), 'delete', 'sms_notification', 'Cleared all SMS notifications for phone '.$parentPhone);
        return redirect()->to('/parents-notifications')->with('msg', 'All SMS notifications cleared.');
    }

    // ===== LEGACY: Combined logs =====
    public function logs()
    {
        $userId = session('user_id');
        $studentModel = new \App\Models\StudentModel();
        $db = \Config\Database::connect();
        
        $studentParents = $db->table('student_parents')
            ->where('parent_id', $userId)
            ->get()
            ->getResultArray();
        
        $studentIds = [];
        foreach ($studentParents as $sp) {
            $studentIds[] = $sp['student_id'];
        }
        
        $subFetchers = $this->subFetcherModel->where('parent_id', $userId)->findAll();
        foreach ($subFetchers as $sf) {
            $studentIds[] = $sf['student_id'];
        }
        
        $studentIds = array_unique($studentIds);
        
        $data['releases'] = [];
        if (!empty($studentIds)) {
            $fetchLogModel = new \App\Models\FetchLogModel();
            $releases = $fetchLogModel
                ->select('fetch_logs.*, students.fname AS sfname, students.mname AS smname, students.lname AS slname, students.grade_section')
                ->join('students', 'students.id = fetch_logs.student_id', 'left')
                ->whereIn('fetch_logs.student_id', $studentIds)
                ->orderBy('time_released', 'DESC')
                ->limit(50)
                ->findAll();

            foreach ($releases as &$release) {
                $release['action'] = 'release';
            }
            $data['releases'] = $releases;
        }

        $data['smsNotifications'] = [];
        $parentPhone = session('phone');
        
        if (!empty($parentPhone)) {
            $smsLogs = $db->table('sms_logs')
                ->select('sms_logs.*')
                ->where('parent_phone', $parentPhone)
                ->orderBy('sent_at', 'DESC')
                ->limit(50)
                ->get()
                ->getResultArray();
            
            foreach ($smsLogs as &$log) {
                $message = $log['message'] ?? '';
                $log['student_fname'] = 'Unknown';
                $log['student_lname'] = '';
                $log['grade_section'] = '';
                
                if (preg_match('/child\s+([^\s]+)\s+([^\s]+)/i', $message, $matches)) {
                    $log['student_fname'] = $matches[1];
                    $log['student_lname'] = $matches[2] ?? '';
                } elseif (preg_match('/for\s+([^\s]+)\s+([^\s]+)/i', $message, $matches)) {
                    $log['student_fname'] = $matches[1];
                    $log['student_lname'] = $matches[2] ?? '';
                } elseif (preg_match('/Your\s+child\s+([^\s]+)\s+([^\s]+)/i', $message, $matches)) {
                    $log['student_fname'] = $matches[1];
                    $log['student_lname'] = $matches[2] ?? '';
                } elseif (preg_match('/Student:\s*([^\s]+)\s*([^\s]+)/i', $message, $matches)) {
                    $log['student_fname'] = $matches[1];
                    $log['student_lname'] = $matches[2] ?? '';
                }
            }
            $data['smsNotifications'] = $smsLogs;
        }
        
        return view('parents_logs', $data);
    }

    /**
     * Parent portal page: My Children (all linked students) + Sub-Fetchers with QR.
     */
    public function children()
    {
        $userId  = session('user_id');
        $role    = session('role');
        if ($role !== 'parent') {
            return redirect()->to('/dashboard')->send();
        }

        $db = \Config\Database::connect();
        $studentModel  = new \App\Models\StudentModel();
        $fetchLogModel = new \App\Models\FetchLogModel();
        $data = ['title' => 'My Children'];
        $data['parentProfile'] = $this->parentsModel->find($userId);

        // Linked students (direct link)
        $studentParents = $db->table('student_parents')
            ->where('parent_id', $userId)
            ->get()
            ->getResultArray();

        $myChildren = [];
        $studentIds = [];
        foreach ($studentParents as $sp) {
            $student = $studentModel->find($sp['student_id']);
            if ($student) {
                $student['relation'] = $sp['relation'] ?? '';
                $myChildren[] = $student;
            }
            $studentIds[] = $sp['student_id'];
        }

        // Adviser per grade/section
        $teacherMap = [];
        foreach ($db->table('teachers')->select('grade_section, fname, lname')->get()->getResultArray() as $t) {
            if (!isset($teacherMap[$t['grade_section']])) {
                $teacherMap[$t['grade_section']] = $t['fname'] . ' ' . $t['lname'];
            }
        }

        // Released-today status per child
        $todayMap = [];
        foreach ($myChildren as $c) {
            $c['teacher'] = $teacherMap[$c['grade_section']] ?? '';
            $c['release_today'] = null;
        }
        if (!empty($studentIds)) {
            $todayReleases = $fetchLogModel
                ->select('student_id, time_released')
                ->whereIn('student_id', $studentIds)
                ->where('DATE(time_released)', date('Y-m-d'))
                ->orderBy('time_released', 'ASC')
                ->findAll();
            foreach ($todayReleases as $tr) {
                if (!isset($todayMap[$tr['student_id']])) {
                    $todayMap[$tr['student_id']] = $tr['time_released'];
                }
            }
            foreach ($myChildren as &$c) {
                $c['release_today'] = $todayMap[$c['id']] ?? null;
            }
            unset($c);
        }

        $data['myChildren'] = $myChildren;

        return view('parents_children', $data);
    }

    /**
     * Parent portal page: Sub-Fetchers list with their QR codes.
     */
    public function subfetchers()
    {
        helper('photo');
        $userId = session('user_id');
        if (session('role') !== 'parent') {
            return redirect()->to('/dashboard')->send();
        }

        $data = ['title' => 'Sub-Fetchers'];
        $data['parentProfile'] = $this->parentsModel->find($userId);
        $data['subFetchers']  = $this->subFetcherModel->where('parent_id', $userId)->findAll();

        return view('parents_subfetchers', $data);
    }

    private function generateQR()
    {
        // Value first, PNG best-effort. The old copy used CWD-relative
        // include/paths and could fatal() the whole parent save.
        $qrValue = $this->generateQrValue();
        $this->generateQrFile($qrValue, 40);
        return $qrValue;
    }
}
