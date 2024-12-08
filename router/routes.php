<?php

$router = new \Bramus\Router\Router();
$router->setNamespace('App\Controllers');

$router->before('GET', '/', 'UserController@authenticated');
$router->get('/', 'ViewController@home');

$router->before('GET', '/dashboard', 'UserController@noAuth');
$router->get('/dashboard', 'ViewController@dashboard');

$router->before('GET', '/detail/(\d+)', 'UserController@noAuth');
$router->get('/detail/(\d+)', 'ViewController@detail');

$router->before('GET', '/formulir/(\d+)', 'UserController@noAuth');
$router->get('/formulir/(\d+)', 'ViewController@formulir');

$router->get('/register', 'ViewController@register');

$router->before('POST', '/products', 'UserController@noAuth');
$router->post('/products', 'ProductController@store');

$router->before('GET', '/product/(\d+)', 'UserController@noAuth');
$router->get('/product/(\d+)', 'ProductController@select');

$router->before('POST', '/product/create', 'UserController@noAuth');
$router->post('/product/create', 'ProductController@create');

$router->before('POST', '/product/search', 'UserController@noAuth');
$router->post('/product/search', 'ProductController@search');

$router->before('POST', '/product/update', 'UserController@noAuth');
$router->post('/product/update', 'ProductController@update');

$router->before('GET', '/product/delete/(\d+)', 'UserController@noAuth');
$router->get('/product/delete/(\d+)', 'ProductController@delete');

$router->post('/user/login', 'UserController@login');
$router->get('/user/logout', 'UserController@logout');

$router->before('GET', '/file/(\w+)', 'UserController@noAuth');
$router->get('/file/(\w+)', 'FileController@select');

$router->before('POST', '/file/create', 'UserController@noAuth');
$router->post('/file/create', 'FileController@create');

$router->post('/file/create/temp', 'FileController@createTemp');

$router->before('POST', '/file/update', 'UserController@noAuth');
$router->post('/file/update', 'FileController@update');

$router->before('GET', '/file/delete/(\d+)', 'UserController@noAuth');
$router->get('/file/delete/(\d+)', 'FileController@delete');

$router->post('/client/register', 'ClientController@register');
$router->get('/client/(\w+)', 'ViewController@verify');

// $router->get('/images/([a-zA-Z0-9\-_]+)', function ($files) {
//     $possibleExtensions = ['jpg', 'jpeg', 'png'];
//     $originalFilePath = null;

//     foreach ($possibleExtensions as $ext) {
//         $path = dirname(__DIR__, 1) . '/files_tmp/' . $files . '.' . $ext;
//         if (file_exists($path)) {
//             $originalFilePath = $path;
//             break;
//         }
//     }

//     if ($originalFilePath) {
//         $fileInfo = new finfo(FILEINFO_MIME_TYPE);
//         $mimeType = $fileInfo->file($originalFilePath);

//         header('Content-Type: ' . $mimeType);
//         header('Content-Disposition: inline; filename="' . rawurlencode(basename($originalFilePath)) . '"');
//         header('Content-Length: ' . filesize($originalFilePath));

//         readfile($originalFilePath);
//         exit;
//     } else {
//         http_response_code(404);
//         echo "Dokumen tidak ditemukan.";
//     }
// });

$router->get('/images/([a-zA-Z0-9\-_]+)', function ($files) {
    $possibleExtensions = ['jpg', 'jpeg', 'png'];
    $possibleDirectories = [
        dirname(__DIR__, 1) . '/files_tmp/',
        dirname(__DIR__, 1) . '/files/'
    ];
    $originalFilePath = null;

    // Cari file di kedua folder
    foreach ($possibleDirectories as $directory) {
        foreach ($possibleExtensions as $ext) {
            $path = $directory . $files . '.' . $ext;
            if (file_exists($path)) {
                $originalFilePath = $path;
                break 2; // Keluar dari kedua loop setelah menemukan file
            }
        }
    }

    // Jika file ditemukan
    if ($originalFilePath) {
        $fileInfo = new finfo(FILEINFO_MIME_TYPE);
        $mimeType = $fileInfo->file($originalFilePath);

        header('Content-Type: ' . $mimeType);
        header('Content-Disposition: inline; filename="' . rawurlencode(basename($originalFilePath)) . '"');
        header('Content-Length: ' . filesize($originalFilePath));

        readfile($originalFilePath);
        exit;
    } else {
        // Jika file tidak ditemukan
        http_response_code(404);
        echo "Dokumen tidak ditemukan.";
    }
});


$router->set404(function () {
    header('location: /');
});

$router->run();
