<?php

use Admin\asm\Controllers\Client\AuthController;
use Admin\asm\Controllers\Client\HomeController;

$router->get( '/', HomeController::class . '@index');

$router->get( '/auth/login',            AuthController::class . '@index');
$router->post( '/auth/handle-login',    AuthController::class . '@login');
$router->get( '/auth/logout',           AuthController::class . '@logout');
$router->get('/auth/register' ,         AuthController::class . '@registerForm');
$router->post('/auth/handle_register' ,         AuthController::class . '@register');






