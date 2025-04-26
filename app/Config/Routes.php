<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */



// Routes untuk autentikasi
$routes->group('', ['namespace' => 'App\Controllers'], function($routes) {
    // GET routes untuk menampilkan form
    $routes->get('register', 'AuthController::register');
    $routes->get('login', 'AuthController::login');
    
    // POST routes untuk memproses form
    $routes->post('register', 'AuthController::processRegister');
    $routes->post('login', 'AuthController::processLogin');
    
    // Logout route
    $routes->get('logout', 'AuthController::logout');
});

// Routes yang membutuhkan autentikasi
$routes->group('', ['namespace' => 'App\Controllers', 'filter' => 'auth'], function($routes) {
    $routes->get('/', 'HomeController::index');
    $routes->get('api/profile', 'Api\AuthApiController::getProfile');
    $routes->get('profile', 'HomeController::profile');
    $routes->post('api/logout', 'Api\AuthApiController::logout');
    $routes->post('api/profile/update', 'Api\AuthApiController::updateProfile');
});

$routes->post('api/registration', 'Api\AuthApiController::register');
$routes->post('api/login', 'Api\AuthApiController::login');
