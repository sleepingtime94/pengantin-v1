<?php

namespace App\Controllers;

use App\Middlewares\Helper;
use App\Models\FileModel;
use App\Models\ProductModel;
use Verot\Upload\Upload;

class FileController
{
    private $fileModel;
    private $productModel;
    private $handle;
    private $helper;

    public function __construct()
    {
        $this->fileModel = new FileModel();
        $this->productModel = new ProductModel();
        $this->handle = new Upload($_FILES['file'], 'id_ID');
        $this->helper = new Helper();
    }

    public function create()
    {
        $reqbody = (object) $_POST;

        if ($this->handle->uploaded) {
            $this->handle->file_new_name_body = $this->helper->randomString();
            $this->handle->file_max_size = 2097152;
            $this->handle->allowed = array('jpg', 'jpeg', 'png');
            $this->handle->forbidden = array();
            $this->handle->process('files/', 'id_ID');
            $this->handle->dir_auto_create = true;
            $this->handle->jpeg_quality = 5;
            $this->handle->png_compression = 5;
            $this->handle->image_resize = true;

            if ($this->handle->processed) {
                $params = [
                    'pid' => $reqbody->pid,
                    'path' => $this->handle->file_dst_name,
                    'category' => $reqbody->category,
                    'logs' => $reqbody->logs ?: md5($this->helper->randomString()),
                ];

                $this->handle->clean();
                if ($reqbody->type == "bt") {
                    switch ($reqbody->gender) {
                        case "lk":
                            $this->productModel->updateById([
                                'id' => $reqbody->pid,
                                'lk_file' => $this->handle->file_dst_name,
                            ]);
                            $this->fileModel->createOne($params);
                            break;
                        case "pr":
                            $this->productModel->updateById([
                                'id' => $reqbody->pid,
                                'pr_file' => $this->handle->file_dst_name,
                            ]);
                            $this->fileModel->createOne($params);
                            break;
                    }
                } else if ($reqbody->type == "bk") {
                    $this->productModel->updateById([
                        'id' => $reqbody->pid,
                        'bk_file' => $this->handle->file_dst_name,
                    ]);
                    $this->fileModel->createOne($params);
                }
                echo json_encode(['status' => 'success', 'message' => 'FILE BERHASIL DITAMBAHKAN', 'path' => $this->handle->file_dst_name]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'GAGAL MENAMBAHKAN FILE']);
            }
        }
    }

    public function createTemp()
    {
        $reqbody = (object) $_POST;

        if ($this->handle->uploaded) {
            $this->handle->file_new_name_body = $this->helper->randomString();
            $this->handle->file_max_size = 2097152;
            $this->handle->allowed = array('jpg', 'jpeg', 'png');
            $this->handle->forbidden = array();
            $this->handle->process('files_temp/', 'id_ID');
            $this->handle->dir_auto_create = true;
            $this->handle->jpeg_quality = 5;
            $this->handle->png_compression = 5;
            $this->handle->image_resize = true;
            if ($this->handle->processed) {
                $params = [
                    'path' => $this->handle->file_dst_name,
                    'category' => $reqbody->category,
                    'logs' => $reqbody->logs ?: md5($this->helper->randomString()),
                ];

                $this->handle->clean();
                $this->fileModel->createTemp($params);
                echo json_encode(['status' => 'success', 'message' => 'FILE BERHASIL DITAMBAHKAN', 'path' => $this->handle->file_dst_pathname]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'GAGAL MENAMBAHKAN FILE']);
            }
        }
    }

    public function select($pid)
    {
        if (!empty($pid)) {
            echo $this->fileModel->findById($pid);
        }
    }

    public function update()
    {
        echo $this->fileModel->updateById($_POST);
    }

    public function delete($pid)
    {
        if (!empty($pid)) {
            echo $this->fileModel->deleteById($pid);
        }
    }
}
