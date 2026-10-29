<?php

namespace App\Controllers;

use App\Models\ActivityLogModel;
use App\Models\StudentModel;

/**
 * Standalone student picture station.
 *
 * Staff 2 opens /photo-capture, types the student id, takes the shot,
 * retakes if needed, then saves. The file lands in
 * public/uploads/students/{student_id}.jpg — the system picks it up by
 * filename, so nothing else has to be imported.
 */
class Photo extends BaseController
{
    private function allowed(): bool
    {
        return in_array(session('role'), ['admin', 'staff', 'teacher'], true);
    }

    public function index()
    {
        if (! $this->allowed()) {
            return redirect()->to('/dashboard')->with('error', 'Access denied.');
        }

        helper('photo');

        return view('photo_capture');
    }

    /** AJAX: does this student id exist, and is there already a photo? */
    public function lookup()
    {
        if (! $this->allowed()) {
            return $this->response->setStatusCode(403)->setJSON(['success' => false]);
        }

        helper('photo');

        $no = student_photo_id($this->request->getGet('student_no'));
        if ($no === '') {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Student ID must be numbers only.',
            ]);
        }

        $db      = \Config\Database::connect();
        $hasCol  = $db->fieldExists('student_no', 'students');
        $student = null;

        if ($hasCol) {
            $student = (new StudentModel())->where('student_no', $no)->first();
        }

        return $this->response->setJSON([
            'success'   => true,
            'validated' => $hasCol,
            'found'     => $student !== null,
            'name'      => $student !== null
                ? trim(($student['fname'] ?? '') . ' ' . ($student['lname'] ?? ''))
                : null,
            'grade'     => $student['grade_section'] ?? null,
            'photo'     => student_photo_url($no),
        ]);
    }

    /** AJAX: decode the captured frame and write uploads/students/{id}.jpg */
    public function save()
    {
        if (! $this->allowed()) {
            return $this->response->setStatusCode(403)->setJSON(['success' => false]);
        }

        helper('photo');

        $no  = student_photo_id($this->request->getPost('student_no'));
        $img = (string) $this->request->getPost('image');

        if ($no === '') {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Student ID is required.',
            ]);
        }

        if ($img === '') {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'No picture captured yet.',
            ]);
        }

        // When the students table has student_no, refuse ids that are not
        // real — that keeps the folder free of orphan files.
        $db = \Config\Database::connect();
        if ($db->fieldExists('student_no', 'students')) {
            $student = (new StudentModel())->where('student_no', $no)->first();
            if ($student === null) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Student ID ' . $no . ' is not registered. Save the information part first.',
                ]);
            }
        }

        if (! photo_save_dataurl($img, $no)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Could not save the picture. Use a JPEG, PNG or WEBP capture.',
            ]);
        }

        (new ActivityLogModel())->addLog(
            session('user_id'),
            session('fname') . ' ' . session('lname'),
            session('role'),
            'update',
            'photo',
            'Student picture saved: ' . $no
        );

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Picture saved for student ' . $no . '.',
            'file'    => 'uploads/students/' . $no . '.jpg',
            'photo'   => student_photo_url($no),
        ]);
    }
}
