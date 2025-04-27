<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */



// Routes untuk autentikasi
$routes->group('', ['namespace' => 'App\Controllers\Api'], function($routes) {
    // GET routes untuk menampilkan form
    $routes->get('register', 'AuthController::register');
    $routes->post('registration', 'AuthController::submitRegistration');
    $routes->get('login', 'AuthController::login');
    $routes->post('login', 'AuthController::submitLogin');
    // Logout route
    $routes->get('logout', 'AuthController::logout');
});

// Routes yang membutuhkan autentikasi
$routes->group('', ['namespace' => 'App\Controllers', 'filter' => 'auth'], function($routes) {
    $routes->get('/', 'HomeController::index');
    $routes->get('topup', 'HomeController::topup');
    $routes->get('profile', 'HomeController::profile');
    $routes->group('', ['namespace' => 'App\Controllers\Api'], function($routes) {
        $routes->post('/profile/update', 'Api\AuthController::updateProfile');
        $routes->post('logout', 'Api\AuthController::logout');
        $routes->post('profile/image', 'Api\AuthController::uploadPhoto');
    });

    $routes->get('transaksi', 'HomeController::transaksi');
    
    $routes->post('topup', 'TransaksiController::topup');
    $routes->get('pbb', 'HomeController::pbb');
    $routes->post('pbb', 'TransaksiController::pbb');
    $routes->get('listrik', 'HomeController::listrik');
    $routes->post('listrik', 'TransaksiController::listrik');
    $routes->get('pulsa', 'HomeController::pulsa');
    $routes->post('pulsa', 'TransaksiController::pulsa');
});
    