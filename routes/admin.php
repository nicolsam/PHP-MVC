<?php

// Mostrar erros
error_reporting(E_ALL);
ini_set('display_errors', '1');

use \App\Http\Response;
use \App\Controller\Admin;

// Rota ADMIN
$obRouter->get('/admin', [
    'middlewares' => [
        'require-admin-login'
    ],
    function() {
        return new Response(200, 'Admin');
    }
]);

// Rota LOGIN
$obRouter->get('/admin/login', [
    'middlewares' => [
        'require-admin-logout'
    ],
    function($request) {
        return new Response(200, Admin\Login::getLogin($request));
    }
]);

// Rota ADMIN (POST)
$obRouter->post('/admin/login', [
    'middlewares' => [
        'require-admin-logout'
    ],
    function($request) {
        return new Response(200, Admin\Login::setLogin($request));
    }
]);

// Rota LOGOUT
$obRouter->get('/admin/logout', [
    'middlewares' => [
        'require-admin-login'
    ],
    function($request) {
        return new Response(200, Admin\Login::setLogout($request));
    }
]);