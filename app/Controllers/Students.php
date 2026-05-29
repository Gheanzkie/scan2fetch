<?php

namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\ActivityLogModel;

class Students extends BaseController
{
    protected $studentModel;
    protected $logModel;

    public function __construct()
    {
        if (!session('logged_in')) {
            return redirect()->to('/login')->send();
        }
        $this->studentModel = new StudentModel();
        $this->logModel     = new ActivityLogModel();
    }

    public function index()
    {
        $data['students'] = $this->studentModel->getAllWithParent();
        return view('students', $data);
    }

    public function save()
    {
        $captureData = $this->request->getPost('picture_capture');
        $pictureName = null;
        if ($captureData && strpos($captureData, 'data:image') === 0) {
            $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $captureData));
            $pictureName = 'student_' . time() . '.png';
            file_put_contents('uploads/students/' . $pictureName, $imageData);
        } else {
            $picture = $this->request->getFile('picture');
            if ($picture && $picture->isValid() && !$picture->hasMoved()) {
                $pictureName = $picture->getRandomName();
                $picture->move('uploads/students', $pictureName);
            }
        }
        $parentId = $this->request->getPost('parent_id');
        $this->studentModel->save([
            'fname' => $this->request->getPost('fname'), 'mname' => $this->request->getPost('mname'),
            'lname' => $this->request->getPost('lname'), 'grade_section' => $this->request->getPost('grade_section'),
            'parent_id' => $parentId, 'picture' => $pictureName, 'created_by' => session('user_id'),
        ]);
        $this->logModel->addLog(session('user_id'), session('fname').' '.session('lname'), session('role'), 'create', 'student', 'Created student: '.$this->request->getPost('fname').' '.$this->request->getPost('lname'));
        return redirect()->to('/parents-view/' . $parentId)->with('msg', 'Student added');
    }

    public function update()
    {
        $id = $this->request->getPost('id');
        $data = ['fname' => $this->request->getPost('fname'), 'mname' => $this->request->getPost('mname'), 'lname' => $this->request->getPost('lname'), 'grade_section' => $this->request->getPost('grade_section'), 'parent_id' => $this->request->getPost('parent_id')];
        $captureData = $this->request->getPost('picture_capture');
        if ($captureData && strpos($captureData, 'data:image') === 0) {
            $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $captureData));
            $pictureName = 'student_' . time() . '.png';
            file_put_contents('uploads/students/' . $pictureName, $imageData);
            $data['picture'] = $pictureName;
        } else {
            $picture = $this->request->getFile('picture');
            if ($picture && $picture->isValid() && !$picture->hasMoved()) {
                $pictureName = $picture->getRandomName();
                $picture->move('uploads/students', $pictureName);
                $data['picture'] = $pictureName;
            }
        }
        $this->studentModel->update($id, $data);
        $this->logModel->addLog(session('user_id'), session('fname').' '.session('lname'), session('role'), 'update', 'student', 'Updated student: '.$data['fname'].' '.$data['lname'].' (ID: '.$id.')');
        return redirect()->to('/parents-view/' . $data['parent_id'])->with('msg', 'Student updated');
    }

    public function delete($id)
    {
        $student = $this->studentModel->find($id);
        $parentId = $student['parent_id'] ?? null;
        $this->studentModel->delete($id);
        $this->logModel->addLog(session('user_id'), session('fname').' '.session('lname'), session('role'), 'delete', 'student', 'Deleted student: '.$student['fname'].' '.$student['lname'].' (ID: '.$id.')');
        return redirect()->to('/parents-view/' . $parentId)->with('msg', 'Student deleted');
    }
}