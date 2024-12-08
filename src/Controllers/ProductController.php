<?php

namespace App\Controllers;

use App\Models\ProductModel;

class ProductController
{
    private $model;
    private $userLevel;
    private $userId;

    public function __construct()
    {
        $this->model = new ProductModel();
        $this->userId = $_SESSION['user_id'];
        $this->userLevel = $_SESSION['user_level'];
    }

    public function store()
    {
        $params = (object) $_POST;
        $limit = 50;
        $page = isset($params->page) ? $params->page : 1;
        $status = ($params->status === '' || $params->status === null) ? null : (int) $params->status;
        $user = !empty($params->user) ? (int) $params->user : null;

        if ($this->userId !== 1) {
            echo $this->model->findAll((int) $page, (int) $limit, (int) $this->userLevel, $this->userId, $status);
        } else {
            echo $this->model->findAll((int) $page, (int) $limit, (int) $this->userLevel, $user,  $status);
        }
    }

    public function search()
    {
        $params = (object) $_POST;
        $keyword = $params->keyword;
        if (!empty($keyword)) {
            echo $this->model->findByKeyword($keyword, $this->userLevel, $this->userId);
        }
    }

    public function create()
    {
        $params = $_POST;
        echo $this->model->createOne($params);
    }

    public function select($pid)
    {
        if (!empty($pid)) {
            echo $this->model->findById($pid);
        }
    }

    public function update()
    {
        echo $this->model->updateById($_POST);
    }

    public function delete($pid)
    {
        if (!empty($pid)) {
            echo $this->model->deleteById($pid);
        }
    }
}
