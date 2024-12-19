<?php

class FileController {
    private $uploadDir = 'uploads/';

    public function uploadFile($file) {
        if ($file['error'] === UPLOAD_ERR_OK) {
            $tmpName = $file['tmp_name'];
            $name = basename($file['name']);
            $uploadFilePath = $this->uploadDir . $name;

            if (move_uploaded_file($tmpName, $uploadFilePath)) {
                return [
                    'status' => 'success',
                    'filePath' => $uploadFilePath
                ];
            } else {
                return [
                    'status' => 'error',
                    'message' => 'Failed to move uploaded file.'
                ];
            }
        } else {
            return [
                'status' => 'error',
                'message' => 'File upload error.'
            ];
        }
    }

    public function downloadFile($filePath) {
        if (file_exists($filePath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($filePath));
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filePath));
            readfile($filePath);
            exit;
        } else {
            return [
                'status' => 'error',
                'message' => 'File not found.'
            ];
        }
    }
}