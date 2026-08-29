<?php

namespace App\Controllers;

/**
 * Simple in-app chat between parents and the "office" (admin/staff).
 *
 * Message flow:
 *   - Parent → office : receiver_id = NULL (any admin/staff can read & reply)
 *   - Office → parent : receiver_id = <parent id> (single conversation per parent)
 *
 * Table `messages` (create it in MySQL if not present):
 *   CREATE TABLE messages (
 *     id INT AUTO_INCREMENT PRIMARY KEY,
 *     sender_id INT NOT NULL,
 *     sender_role VARCHAR(20) NOT NULL,      -- parent | staff | admin
 *     receiver_id INT NULL,                  -- NULL = to the office
 *     message TEXT NOT NULL,
 *     is_read TINYINT(1) NOT NULL DEFAULT 0,
 *     created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
 *   ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
 */
class Messages extends BaseController
{
    public function __construct()
    {
        if (!session('logged_in')) {
            return redirect()->to('/login')->send();
        }
    }

    public function index()
    {
        $role = session('role');
        $me   = (int) session('user_id');
        $db   = \Config\Database::connect();

        $data = ['title' => 'Messages'];

        if ($role == 'parent') {
            // Single conversation between this parent and the school office.
            $data['thread'] = $db->table('messages')
                ->where("(sender_role = 'parent' AND sender_id = {$me}) OR receiver_id = {$me}")
                ->orderBy('created_at', 'ASC')
                ->get()
                ->getResultArray();

            foreach ($data['thread'] as &$m) {
                $m['message'] = $this->dec($m['message']);
            }
            unset($m);

            // Mark incoming office replies as read.
            $db->table('messages')
                ->where('receiver_id', $me)
                ->where('is_read', 0)
                ->update(['is_read' => 1]);
        } else {
            // Office inbox (admin/staff): one thread per parent.
            $data['threads'] = $this->officeThreads($db);

            $with = (int) $this->request->getGet('with');
            if ($with > 0) {
                $data['selected_id']   = $with;
                $data['selected']      = $db->table('parents')->where('id', $with)->get()->getRowArray();
                $data['selectedThread'] = $this->threadForParent($db, $with);
                foreach ($data['selectedThread'] as &$m) {
                    $m['message'] = $this->dec($m['message']);
                }
                unset($m);
                $this->markParentRead($db, $with);
            }
        }

        return view('messages', $data);
    }

    public function send()
    {
        if (!session('logged_in')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $text = trim($this->request->getPost('message'));
        if ($text === '') {
            return $this->response->setJSON(['success' => false, 'message' => 'Message is empty.']);
        }

        $role = session('role');
        $me   = (int) session('user_id');
        $db   = \Config\Database::connect();

        if ($role == 'parent') {
            $db->table('messages')->insert([
                'sender_id'   => $me,
                'sender_role' => 'parent',
                'receiver_id' => null,
                'message'     => $this->enc($text),
                'is_read'     => 0,
                'created_at'  => date('Y-m-d H:i:s'),
            ]);
        } else {
            $toParent = (int) $this->request->getPost('to_parent');
            if ($toParent <= 0) {
                return $this->response->setJSON(['success' => false, 'message' => 'No conversation selected.']);
            }
            $db->table('messages')->insert([
                'sender_id'   => $me,
                'sender_role' => $role,
                'receiver_id' => $toParent,
                'message'     => $this->enc($text),
                'is_read'     => 0,
                'created_at'  => date('Y-m-d H:i:s'),
            ]);
        }

        return $this->response->setJSON(['success' => true]);
    }

    public function getThread($parentId)
    {
        if (!session('logged_in')) {
            return $this->response->setJSON(['success' => false]);
        }

        $pid = (int) $parentId;
        if ($pid <= 0) {
            return $this->response->setJSON(['success' => false]);
        }

        $role = session('role');
        $me   = (int) session('user_id');

        // A parent may only load their OWN conversation.
        if ($role == 'parent') {
            if ($pid !== $me) {
                return $this->response->setJSON(['success' => false]);
            }
        }

        $db   = \Config\Database::connect();
        $rows = $this->threadForParent($db, $pid);

        foreach ($rows as &$m) {
            $m['message'] = $this->dec($m['message']);
        }
        unset($m);

        if ($role != 'parent') {
            $this->markParentRead($db, $pid);
        }

        return $this->response->setJSON(['success' => true, 'messages' => $rows]);
    }

    public function unread()
    {
        if (!session('logged_in')) {
            return $this->response->setJSON(['count' => 0]);
        }

        $role = session('role');
        $me   = (int) session('user_id');
        $db   = \Config\Database::connect();

        if ($role == 'parent') {
            $count = $db->table('messages')->where('receiver_id', $me)->where('is_read', 0)->countAllResults();
        } elseif ($role == 'teacher') {
            $count = 0;
        } else {
            $count = $db->table('messages')->where('sender_role', 'parent')->where('is_read', 0)->countAllResults();
        }

        return $this->response->setJSON(['count' => (int) $count]);
    }

    // ================= HELPERS =================

    // Encrypt a message before it is stored. The result is stored
    // base64-encoded so it survives storage in a utf8mb4 TEXT column.
    // Key comes from `encryption.key` in .env (AES-256-CTR, CI4 Encryption service).
    private function enc(string $plain): string
    {
        return base64_encode(\Config\Services::encrypter()->encrypt($plain));
    }

    // Decrypt a stored message. Falls back to the raw value if decryption
    // fails (e.g. legacy plaintext rows or a missing/changed key).
    private function dec(string $stored): string
    {
        if ($stored === '') {
            return $stored;
        }
        try {
            return \Config\Services::encrypter()->decrypt(base64_decode($stored, true));
        } catch (\Throwable $e) {
            return $stored;
        }
    }

    private function threadForParent($db, int $pid): array
    {
        return $db->table('messages')
            ->where("(sender_role = 'parent' AND sender_id = {$pid}) OR receiver_id = {$pid}")
            ->orderBy('created_at', 'ASC')
            ->get()
            ->getResultArray();
    }

    private function markParentRead($db, int $pid): void
    {
        $db->table('messages')
            ->where('sender_role', 'parent')
            ->where('sender_id', $pid)
            ->where('is_read', 0)
            ->update(['is_read' => 1]);
    }

    private function officeThreads($db): array
    {
        $parents = $db->table('messages')
            ->select('sender_id')
            ->distinct()
            ->where('sender_role', 'parent')
            ->get()
            ->getResultArray();

        $threads = [];
        foreach ($parents as $p) {
            $pid = (int) $p['sender_id'];
            $parent = $db->table('parents')->where('id', $pid)->get()->getRowArray();
            if (!$parent) {
                continue;
            }

            $last = $db->table('messages')
                ->where("(sender_role = 'parent' AND sender_id = {$pid}) OR receiver_id = {$pid}")
                ->orderBy('created_at', 'DESC')
                ->limit(1)
                ->get()
                ->getRowArray();

            $unread = $db->table('messages')
                ->where('sender_role', 'parent')
                ->where('sender_id', $pid)
                ->where('is_read', 0)
                ->countAllResults();

            $threads[] = [
                'parent_id'    => $pid,
                'fname'        => $parent['fname'],
                'lname'        => $parent['lname'],
                'phone'        => $parent['phone'],
                'last_message' => $last ? $this->dec($last['message']) : '',
                'last_time'    => $last['created_at'] ?? '',
                'unread'       => (int) $unread,
            ];
        }

        usort($threads, function ($a, $b) {
            return strcmp($b['last_time'], $a['last_time']);
        });

        return $threads;
    }
}