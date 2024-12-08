<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Middlewares\CSRFProtection;

class UserController
{
    private $userModel;
    private $csrfProtection;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->csrfProtection = new CSRFProtection();
    }

    public function login()
    {
        $params = (object) $_POST;
        $username = strtolower($params->username);

        if ($this->csrfProtection->isValidToken($params->csrfToken) !== false) {
            $users = json_decode($this->userModel->findById($username))->data[0];
            if (password_verify($params->password, $users->password)) {
                $_SESSION['user_auth'] = base64_encode(date('dmyhis'));
                $_SESSION['user_id'] = $users->id;
                $_SESSION['user_level'] = $users->level;
                $_SESSION['user_name'] = $users->name;

                session_regenerate_id(true);

                echo json_encode([
                    'status' => 'success',
                    'message' => 'Login sukses! Mengalihkan kehalaman dashboard.'
                ]);
            } else {
                echo json_encode([
                    'status' => 'failed',
                    'message' => 'Periksa kembali nama pengguna dan kata sandi.'
                ]);
            }
        } else {
            echo json_encode([
                'status' => 'failed',
                'message' => 'Mohon maaf, terjadi kesalahan. Silahkan coba lagi.'
            ]);
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header('location: /');
        exit();
    }

    public function noAuth()
    {
        if (!isset($_SESSION['user_auth'])) {
            header('location: /');
            exit();
        }
    }

    public function authenticated()
    {
        if (isset($_SESSION['user_auth'])) {
            header('location: /dashboard');
            exit();
        }
    }
}
