<?php

namespace App\Controllers;

use Gumlet\ImageResize;
use App\Models\FileModel;
use App\Models\ProductModel;
use finfo;

class FileController
{
    private $fileModel;
    private $productModel;

    public function __construct()
    {
        $this->fileModel = new FileModel();
        $this->productModel = new ProductModel();
    }

    public function create()
    {
        $imageFile = $_FILES['file'];
        $tempPath = $imageFile['tmp_name'];
        $image = new ImageResize($tempPath);
        $fileExtension = strtolower(pathinfo($imageFile['name'], PATHINFO_EXTENSION));
        $randomFileName = bin2hex(random_bytes(8)) . '.' . $fileExtension;
        $logs = md5(bin2hex(random_bytes(5)));
        $destinationPath = '../files/' . $randomFileName;

        $image->resizeToWidth(600);
        $image->save($destinationPath);

        $requestBody = (object) $_POST;
        $params = [
            'pid' => $requestBody->pid,
            'path' => $randomFileName,
            'category' => $requestBody->category,
            'logs' => $requestBody->logs ?: $logs,
        ];

        if (in_array($requestBody->type, ["bt", "bk"])) {
            $updateData = ['id' => $requestBody->pid];

            if ($requestBody->type == "bt") {
                $updateField = ($requestBody->gender == "lk") ? 'lk_file' : 'pr_file';
                $updateData[$updateField] = $randomFileName;
            } else if ($requestBody->type == "bk") {
                $updateData['bk_file'] = $randomFileName;
            }

            $this->productModel->updateById($updateData);
            $this->fileModel->createOne($params);
        }

        echo json_encode(['status' => 'success', 'message' => 'File berhasil ditambahkan.', 'path' => $destinationPath]);
    }

    public function createTemp()
    {
        $imageFile = $_FILES['file'];
        $tempPath = $imageFile['tmp_name'];
        $image = new ImageResize($tempPath);
        $fileExtension = strtolower(pathinfo($imageFile['name'], PATHINFO_EXTENSION));
        $randomFileName = bin2hex(random_bytes(8)) . '.' . $fileExtension;
        $logs = md5(bin2hex(random_bytes(5)));
        $destinationPath = '../files_tmp/' . $randomFileName;


        $image->resizeToWidth(600);
        $image->save($destinationPath);
        $requestBody = (object) $_POST;
        $params = [
            'path' => $randomFileName,
            'category' => $requestBody->category,
            'logs' => $requestBody->logs ?: $logs,
        ];
        $this->fileModel->createTemp($params);
        echo json_encode(['status' => 'success', 'message' => 'File berhasil ditambahkan.', 'path' => $destinationPath]);
    }

    public function redirectPath($files)
    {
        $possibleExtensions = ['jpg', 'jpeg', 'png'];
        $possibleDirectories = [
            dirname(__DIR__, 2) . '/files_tmp/',
            dirname(__DIR__, 2) . '/files/'
        ];
        $originalFilePath = null;

        foreach ($possibleDirectories as $directory) {
            foreach ($possibleExtensions as $ext) {
                $path = $directory . $files . '.' . $ext;
                if (file_exists($path)) {
                    $originalFilePath = $path;
                    break 2;
                }
            }
        }

        if ($originalFilePath) {
            $fileInfo = new finfo(FILEINFO_MIME_TYPE);
            $mimeType = $fileInfo->file($originalFilePath);

            header('Content-Type: ' . $mimeType);
            header('Content-Disposition: inline; filename="' . rawurlencode(basename($originalFilePath)) . '"');
            header('Content-Length: ' . filesize($originalFilePath));

            readfile($originalFilePath);
            exit;
        } else {
            http_response_code(404);
            echo "Dokumen tidak ditemukan.";
        }
    }
}
