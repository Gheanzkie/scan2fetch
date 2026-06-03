<?php

namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\ParentsModel;
use App\Models\SubFetcherModel;
use App\Models\ActivityLogModel;

class Students extends BaseController
{
    protected $studentModel;
    protected $parentsModel;
    protected $subFetcherModel;
    protected $logModel;

    public function __construct()
    {
        if (!session('logged_in')) {
            return redirect()->to('/login')->send();
        }
        $this->studentModel    = new StudentModel();
        $this->parentsModel    = new ParentsModel();
        $this->subFetcherModel = new SubFetcherModel();
        $this->logModel        = new ActivityLogModel();
    }

    // ========== LIST ==========
    public function index()
    {
        $data['students'] = $this->studentModel->orderBy('created_at', 'DESC')->findAll();
        return view('students', $data);
    }

    // ========== VIEW ==========
    public function view($id)
    {
        $data['student'] = $this->studentModel->find($id);
        if (!$data['student']) return redirect()->to('/students')->with('error', 'Student not found');

        $data['parents'] = $this->parentsModel
            ->select('parents.*, student_parents.relation, parents.id as parent_id')
            ->join('student_parents', 'student_parents.parent_id = parents.id')
            ->where('student_parents.student_id', $id)
            ->findAll();

        $data['parentCount'] = count($data['parents']);
        $data['subFetchers'] = $this->subFetcherModel->where('student_id', $id)->findAll();

        return view('students_view', $data);
    }

    // ========== ADD FORM ==========
    public function add()
    {
        return view('students_add');
    }

    // ========== EDIT FORM ==========
    public function edit($id)
    {
        $data['student'] = $this->studentModel->find($id);
        if (!$data['student']) return redirect()->to('/students')->with('error', 'Student not found');
        return view('students_edit', $data);
    }

    // ========== SAVE STUDENT + PARENTS + FETCHERS ==========
    public function save()
    {
        $pictureName = $this->uploadStudentPicture();

        $studentId = $this->studentModel->insert([
            'fname'         => $this->request->getPost('fname'),
            'mname'         => $this->request->getPost('mname'),
            'lname'         => $this->request->getPost('lname'),
            'grade_section' => $this->request->getPost('grade_section'),
            'picture'       => $pictureName,
            'created_by'    => session('user_id'),
        ]);

        $firstParentId = null;

        // Save parents
        $parentFnames = $this->request->getPost('parent_fname');
        if ($parentFnames) {
            $parentMnames    = $this->request->getPost('parent_mname');
            $parentLnames    = $this->request->getPost('parent_lname');
            $parentPhones    = $this->request->getPost('parent_phone');
            $parentRelations = $this->request->getPost('parent_relation');
            $parentPasswords = $this->request->getPost('parent_password');

            foreach ($parentFnames as $i => $fname) {
                if (empty($fname) || $i >= 3) continue;

                $qrValue = $this->generateQR();
                $parentId = $this->parentsModel->insert([
                    'fname'      => $fname,
                    'mname'      => $parentMnames[$i] ?? null,
                    'lname'      => $parentLnames[$i],
                    'phone'      => $parentPhones[$i],
                    'password'   => password_hash($parentPasswords[$i] ?? 'parent123', PASSWORD_DEFAULT),
                    'qr_code'    => $qrValue,
                    'created_by' => session('user_id'),
                ]);

                if ($firstParentId === null) {
                    $firstParentId = $parentId;
                }

                $this->parentsModel->db->table('student_parents')->insert([
                    'student_id' => $studentId,
                    'parent_id'  => $parentId,
                    'relation'   => $parentRelations[$i] ?? 'Parent',
                ]);
            }
        }

        // Save fetchers to sub_fetchers table
        // Save fetchers to sub_fetchers table
        $fetcherFnames = $this->request->getPost('fetcher_fname');
        if ($fetcherFnames) {
            $fetcherMnames = $this->request->getPost('fetcher_mname');
            $fetcherLnames = $this->request->getPost('fetcher_lname');
            $fetcherPhones = $this->request->getPost('fetcher_phone');

            foreach ($fetcherFnames as $i => $fname) {
                if (empty($fname) || $i >= 2) continue;

                $qrValue = $this->generateQR();
                $this->subFetcherModel->insert([
                    'parent_id'  => $firstParentId,
                    'student_id' => $studentId,
                    'fname'      => $fname,
                    'mname'      => $fetcherMnames[$i] ?? null,
                    'lname'      => $fetcherLnames[$i],
                    'phone'      => $fetcherPhones[$i],
                    'qr_code'    => $qrValue,
                    'created_by' => session('user_id'),
                ]);
            }
        }

        $this->logModel->addLog(session('user_id'), session('fname').' '.session('lname'), session('role'), 'create', 'student', 'Created: '.$this->request->getPost('fname').' '.$this->request->getPost('lname'));
        return redirect()->to('/students')->with('msg', 'Student, Parents & Fetchers registered');
    }

    // ========== UPDATE STUDENT ==========
    public function update()
    {
        $id = $this->request->getPost('id');
        $data = [
            'fname' => $this->request->getPost('fname'),
            'mname' => $this->request->getPost('mname'),
            'lname' => $this->request->getPost('lname'),
            'grade_section' => $this->request->getPost('grade_section'),
        ];
        $pictureName = $this->uploadStudentPicture();
        if ($pictureName) $data['picture'] = $pictureName;
        $this->studentModel->update($id, $data);
        $this->logModel->addLog(session('user_id'), session('fname').' '.session('lname'), session('role'), 'update', 'student', 'Updated: '.$data['fname'].' '.$data['lname'].' (ID: '.$id.')');
        return redirect()->to('/students-view/' . $id)->with('msg', 'Student updated');
    }

    // ========== DELETE STUDENT ==========
    public function delete($id)
    {
        $student = $this->studentModel->find($id);
        $this->studentModel->delete($id);
        $this->logModel->addLog(session('user_id'), session('fname').' '.session('lname'), session('role'), 'delete', 'student', 'Deleted: '.$student['fname'].' '.$student['lname'].' (ID: '.$id.')');
        return redirect()->to('/students')->with('msg', 'Student deleted');
    }

    // ========== REMOVE PARENT ==========
    public function removeParent($studentId, $parentId)
    {
        $db = \Config\Database::connect();
        $db->table('student_parents')->where('student_id', $studentId)->where('parent_id', $parentId)->delete();

        $count = $db->table('student_parents')->where('parent_id', $parentId)->countAllResults();
        if ($count == 0) {
            $this->parentsModel->delete($parentId);
        }

        $this->logModel->addLog(session('user_id'), session('fname').' '.session('lname'), session('role'), 'update', 'student', 'Removed parent (ID: '.$parentId.') from student (ID: '.$studentId.')');
        return redirect()->to('/students-view/' . $studentId)->with('msg', 'Parent removed');
    }

    // ========== ADD PARENT ==========
    public function addParent()
    {
        $studentId = $this->request->getPost('student_id');
        $db = \Config\Database::connect();
        if ($db->table('student_parents')->where('student_id', $studentId)->countAllResults() >= 3) {
            return redirect()->to('/students-view/' . $studentId)->with('error', 'Maximum 3 parents');
        }

        $pictureName = $this->uploadParentPicture();
        $qrValue = $this->generateQR();

        $parentId = $this->parentsModel->insert([
            'fname'      => $this->request->getPost('fname'),
            'mname'      => $this->request->getPost('mname'),
            'lname'      => $this->request->getPost('lname'),
            'phone'      => $this->request->getPost('phone'),
            'password'   => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'picture'    => $pictureName,
            'qr_code'    => $qrValue,
            'created_by' => session('user_id'),
        ]);

        $db->table('student_parents')->insert([
            'student_id' => $studentId,
            'parent_id'  => $parentId,
            'relation'   => $this->request->getPost('relation') ?? 'Parent',
        ]);

        $this->logModel->addLog(session('user_id'), session('fname').' '.session('lname'), session('role'), 'create', 'parent', 'Added: '.$this->request->getPost('fname').' '.$this->request->getPost('lname'));
        return redirect()->to('/students-view/' . $studentId)->with('msg', 'Parent added');
    }

    // ========== HELPERS ==========
    private function uploadStudentPicture()
    {
        $captureData = $this->request->getPost('picture_capture');
        if ($captureData && strpos($captureData, 'data:image') === 0) {
            $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $captureData));
            $name = 'student_' . time() . '.png';
            file_put_contents('uploads/students/' . $name, $imageData);
            return $name;
        }
        $file = $this->request->getFile('picture');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $name = $file->getRandomName();
            $file->move('uploads/students', $name);
            return $name;
        }
        return null;
    }

    private function uploadParentPicture()
    {
        $captureData = $this->request->getPost('picture_capture');
        if ($captureData && strpos($captureData, 'data:image') === 0) {
            $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $captureData));
            $name = 'parent_' . time() . '.png';
            file_put_contents('uploads/parents/' . $name, $imageData);
            return $name;
        }
        $file = $this->request->getFile('picture');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $name = $file->getRandomName();
            $file->move('uploads/parents', $name);
            return $name;
        }
        return null;
    }

    private function generateQR()
    {
        $qrValue = 'QR-' . strtoupper(bin2hex(random_bytes(6)));
        include_once('phpqrcode/qrlib.php');
        \QRcode::png($qrValue, 'uploads/qr/' . $qrValue . '.png', QR_ECLEVEL_H, 8, 2);
        return $qrValue;
    }
}