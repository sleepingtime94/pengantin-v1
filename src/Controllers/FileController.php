<?php

namespace App\Controllers;

use Gumlet\ImageResize;
use App\Models\FileModel;
use App\Models\ProductModel;

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
}
