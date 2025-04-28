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
        $routes->post('profile/update', 'AuthController::updateProfile');
        $routes->post('logout', 'AuthController::logout');
        $routes->post('profile/image', 'AuthController::uploadPhoto');
    });

    $routes->get('transaksi/history', 'HomeController::transaksi');
    $routes->get('transaction/more', 'HomeController::getMoreHistory');

    // Routes transaksi
    $routes->post('topup', 'TransaksiController::topup');

    $routes->get('pbb', 'HomeController::pbb');
    $routes->post('pbb', 'TransaksiController::pbb');

    $routes->get('listrik', 'HomeController::listrik');
    $routes->post('listrik', 'TransaksiController::listrik');

    $routes->get('pulsa', 'HomeController::pulsa');
    $routes->post('pulsa', 'TransaksiController::pulsa');

    $routes->get('pdam', 'HomeController::pdam');
    $routes->post('pdam', 'TransaksiController::pdam');

    $routes->get('pgn', 'HomeController::pgn');
    $routes->post('pgn', 'TransaksiController::pgn');

    $routes->get('tv-langganan', 'HomeController::tv_langganan');
    $routes->post('tv-langganan', 'TransaksiController::tv_langganan');

    $routes->get('musik', 'HomeController::musik');
    $routes->post('musik', 'TransaksiController::musik');

    $routes->get('voucher-game', 'HomeController::voucher_game');
    $routes->post('voucher-game', 'TransaksiController::voucher_game');

    $routes->get('voucher-makanan', 'HomeController::voucher_makanan');
    $routes->post('voucher-makanan', 'TransaksiController::voucher_makanan');

    $routes->get('kurban', 'HomeController::kurban');
    $routes->post('kurban', 'TransaksiController::kurban');

    $routes->get('zakat', 'HomeController::zakat');
    $routes->post('zakat', 'TransaksiController::zakat');
    
    $routes->get('paket-data', 'HomeController::paket_data');
    $routes->post('paket-data', 'TransaksiController::paket_data');
});


    