<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\FileModel;

class ClientController
{
    private $productModel;
    private $fileModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->fileModel = new FileModel();
    }

    public function register()
    {
        $req = (object) $_POST;
        $params = [
            'lk_name' => $req->lk_name,
            'pr_name' => $req->pr_name,
            'lk_nik' => $req->lk_nik,
            'pr_nik' => $req->pr_nik,
            'lk_kk' => $req->lk_kk,
            'pr_kk' => $req->pr_kk,
            'lk_address' => $req->lk_address,
            'pr_address' => $req->pr_address,
            'lk_phone' => $req->lk_phone,
            'pr_phone' => $req->pr_phone,
            'notes' => $req->notes,
            'address' => $req->address,
            'logs' => $req->logs,
            'id_user' => $req->id_user,
        ];

        $nullOrEmptyCount = 0;
        foreach ($params as $key => $value) {
            if (is_null($value) || $value === '') {
                $nullOrEmptyCount++;
            }
        }

        if ($nullOrEmptyCount > 0) {
            echo json_encode(['status' => 'error', 'message' => 'MOHON ISI DENGAN LENGKAP SEMUA DATA']);
        } else {
            echo json_encode(['status' => 'success', 'message' => 'PERMOHONAN DITERIMA MENUNGGU DIVERIFIKASI']);
            $this->productModel->createOne($params);
            $this->moveFile($req->logs);
        }
    }

    public function moveFile($logs)
    {
        $result = json_decode($this->fileModel->findByLogsTemp($logs));
        foreach ($result->data as $item) {
            $sourceFile = 'files_temp/' . $item->path;
            $destinationDir = 'files/';
            $destinationFile = $destinationDir . basename($sourceFile);
            rename($sourceFile, $destinationFile);

            $this->fileModel->createOne([
                'path' => $item->path,
                'category' => $item->category,
                'logs' => $logs
            ]);
        }
        $this->fileModel->removeTempFile($logs);
    }
}
