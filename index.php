<?php

function base_url()
{
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $host = $_SERVER['HTTP_HOST'];
    $script_name = dirname($_SERVER['SCRIPT_NAME']);
    $base_url = $protocol . $host . $script_name . '/';

    return $base_url;
}

// Autoload untuk memuat kelas secara otomatis
spl_autoload_register(function ($class_name) {
    include 'controllers/' . $class_name . '.php';
});

// Routing untuk menentukan kontroller dan aksi yang dipanggil 
// default controller adalah home action
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'home';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// Instansiasi kontroller yang sesuai
$controllerName = $controller . 'Controller';
$controllerInstance = new $controllerName();

// Panggil aksi yang sesuai
$controllerInstance->$action();
