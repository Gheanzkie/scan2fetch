<?php

namespace App\Controllers;

use App\Models\SubFetcherModel;
use App\Models\ActivityLogModel;

class SubFetchers extends BaseController
{
    protected $subFetcherModel;
    protected $logModel;

    public function __construct()
    {
        if (!session('logged_in')) {
            return redirect()->to('/login')->send();
        }
        $this->subFetcherModel = new SubFetcherModel();
        $this->logModel        = new ActivityLogModel();
    }

    public function save()
    {
        $parentId  = $this->request->getPost('parent_id');
        $studentId = $this->request->getPost('student_id');

        if ($this->subFetcherModel->where('parent_id', $parentId)->countAllResults() >= 2) {
            return redirect()->to('/parents-view/' . $parentId)->with('error', 'Maximum 2 sub-fetchers');
        }

        $qrValue = $this->generateQR();

        $this->subFetcherModel->insert([
            'parent_id'  => $parentId,
            'student_id' => $studentId,
            'fname'      => $this->request->getPost('fname'),
            'mname'      => $this->request->getPost('mname'),
            'lname'      => $this->request->getPost('lname'),
            'phone'      => $this->request->getPost('phone'),
            'qr_code'    => $qrValue,
            'created_by' => session('user_id'),
        ]);

        $this->logModel->addLog(session('user_id'), session('fname').' '.session('lname'), session('role'), 'create', 'sub_fetcher', 'Added: '.$this->request->getPost('fname').' '.$this->request->getPost('lname'));
        return redirect()->to('/parents-view/' . $parentId)->with('msg', 'Sub-Fetcher added');
    }

    public function update()
    {
        $id = $this->request->getPost('id');
        $parentId = $this->request->getPost('parent_id');

        $data = [
            'fname' => $this->request->getPost('fname'),
            'mname' => $this->request->getPost('mname'),
            'lname' => $this->request->getPost('lname'),
            'phone' => $this->request->getPost('phone'),
        ];

        $captureData = $this->request->getPost('picture_capture');
        if ($captureData && strpos($captureData, 'data:image') === 0) {
            $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $captureData));
            $pictureName = 'subfetcher_' . time() . '.png';
            file_put_contents('uploads/parents/' . $pictureName, $imageData);
            $data['picture'] = $pictureName;
        } else {
            $file = $this->request->getFile('picture');
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $pictureName = $file->getRandomName();
                $file->move('uploads/parents', $pictureName);
                $data['picture'] = $pictureName;
            }
        }

        $this->subFetcherModel->update($id, $data);
        $this->logModel->addLog(session('user_id'), session('fname').' '.session('lname'), session('role'), 'update', 'sub_fetcher', 'Updated ID: '.$id);
        return redirect()->to('/parents-view/' . $parentId)->with('msg', 'Sub-Fetcher updated');
    }

    public function delete($parentId, $id)
    {
        $this->subFetcherModel->delete($id);
        $this->logModel->addLog(session('user_id'), session('fname').' '.session('lname'), session('role'), 'delete', 'sub_fetcher', 'Deleted ID: '.$id);
        return redirect()->to('/parents-view/' . $parentId)->with('msg', 'Sub-Fetcher removed');
    }

    /**
     * Generate QR code with text label below it
     */
    private function generateQR()
    {
        $qrValue = 'QR-' . strtoupper(bin2hex(random_bytes(6)));
        include_once('phpqrcode/qrlib.php');
        
        // Generate the QR code image first
        $qrImagePath = 'uploads/qr/' . $qrValue . '_qrcode.png';
        \QRcode::png($qrValue, $qrImagePath, QR_ECLEVEL_H, 8, 2);
        
        // Create a new image with space for text below QR code
        $qrImage = imagecreatefrompng($qrImagePath);
        $qrWidth = imagesx($qrImage);
        $qrHeight = imagesy($qrImage);
        
        // Set dimensions for the combined image
        $textHeight = 40;
        $padding = 10;
        $totalWidth = $qrWidth;
        $totalHeight = $qrHeight + $textHeight + $padding;
        
        // Create new canvas
        $combinedImage = imagecreatetruecolor($totalWidth, $totalHeight);
        
        // White background
        $white = imagecolorallocate($combinedImage, 255, 255, 255);
        imagefill($combinedImage, 0, 0, $white);
        
        // Copy QR code to top
        imagecopy($combinedImage, $qrImage, 0, 0, 0, 0, $qrWidth, $qrHeight);
        
        // Add text below QR code
        $black = imagecolorallocate($combinedImage, 0, 0, 0);
        $fontSize = 5;
        $text = $qrValue;
        
        // Calculate text position (centered)
        $textWidth = imagefontwidth($fontSize) * strlen($text);
        $textX = ($totalWidth - $textWidth) / 2;
        $textY = $qrHeight + 12;
        
        // Draw text
        imagestring($combinedImage, $fontSize, $textX, $textY, $text, $black);
        
        // Save the combined image
        $finalPath = 'uploads/qr/' . $qrValue . '.png';
        imagepng($combinedImage, $finalPath);
        
        // Clean up
        imagedestroy($qrImage);
        imagedestroy($combinedImage);
        
        // Delete the QR-only file
        if (file_exists($qrImagePath)) {
            unlink($qrImagePath);
        }
        
        return $qrValue;
    }
}