<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\FileModel;
use App\Middlewares\CSRFProtection;

class ViewController
{
    private $product;
    private $files;
    private $users;
    private $csrfProtection;

    public function __construct()
    {
        $this->product = new ProductModel();
        $this->files = new FileModel();
        $this->users = $_SESSION['user_id'];
        $this->csrfProtection = new CSRFProtection();
    }

    public function home()
    {
        $kua = array_map(fn($i) => $this->product->countTotalByUser($i), range(2, 13));

        $params = [
            'totalProduct' => $this->product->countTotal(null),
            'totalVerify' => $this->product->countTotal(1),
            'totalProcess' => $this->product->countTotal(2),
            'totalComplete' => $this->product->countTotal(3),
            'totalByUser' => $kua,
            'captcha' => $this->captcha(),
            'csrfToken' => $this->csrfProtection->getToken(),
        ];

        $this->render('home', $params);
    }

    public function dashboard()
    {
        $isDefaultUser = $this->users === 1;

        $params = [
            'totalProduct' => $isDefaultUser ? $this->product->countTotal(null) : $this->product->countTotalByUser($this->users),
            'totalVerify' => $isDefaultUser ? $this->product->countTotal(0) : $this->product->countTotalByUserStatus($this->users, 0),
            'totalValidation' => $isDefaultUser ? $this->product->countTotal(1) : $this->product->countTotalByUserStatus($this->users, 1),
            'totalProcess' => $isDefaultUser ? $this->product->countTotal(2) : $this->product->countTotalByUserStatus($this->users, 2),
            'totalComplete' => $isDefaultUser ? $this->product->countTotal(3) : $this->product->countTotalByUserStatus($this->users, 3),
        ];

        $this->render('dashboard', $params, true);
    }

    public function detail($pid)
    {
        $products = (object) $this->product->findById($pid)[0];

        $files = (object) $this->files->findByIdLogs($products->id, $products->logs);

        $params = [
            'product' => $products,
            'files' => $files->data,
        ];

        if ($products) {
            $this->render('detail', $params, true);
        } else {
            header('Location: /dashboard');
            exit();
        }
    }

    public function formulir($id)
    {
        $params = $this->product->findById($id)[0];
        $this->render('formulir', $params, false);
    }

    public function register()
    {
        $lastID = $this->product->lastProductID();
        $pid = $lastID + 1;
        $params = ['logs' => $this->randomString(), 'pid' => $pid];
        $this->render('register', $params, false);
    }

    public function verify($logs)
    {
        $this->render('verify', ['logs' => $logs], false);
    }




    public function render($page, $params, $navbar = false)
    {
        $params = (object) $params;

        if ($navbar != false) {
            include_once '../views/layouts/header.php';
            include_once '../views/layouts/navbar.php';
            include_once '../views/' . $page . '.php';
            include_once '../views/layouts/footer.php';
        } else {
            include_once '../views/layouts/header.php';
            include_once '../views/' . $page . '.php';
            include_once '../views/layouts/footer.php';
        }
    }

    public function captcha()
    {
        $characters = array_merge(range('a', 'z'), range(0, 9));
        $randomString = '';
        for ($i = 0; $i < 5; $i++) {
            $randomString .= $characters[mt_rand(0, count($characters) - 1)];
        }
        return $randomString;
    }

    public function randomString($length = 20)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
