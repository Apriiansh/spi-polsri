<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');
$routes->get('search', 'Search::index');

// Login Routes
$routes->get('login', 'AuthController::index');
$routes->post('login', 'AuthController::login');

$routes->get('logout', 'AuthController::logout');

$routes->group('', function ($routes) {
    // Halaman Profil
    $routes->get('profil/sejarah', 'Home::sejarah');
    $routes->get('profil/struktur', 'Home::struktur');
    $routes->get('profil/visimisi', 'Home::visimisi');

    // Halaman Kegiatan & Laporan
    $routes->get('kegiatan', 'PublicKegiatanController::index');
    $routes->get('kegiatan/(:any)', 'PublicKegiatanController::show/$1');
    
    $routes->get('artikel', 'PublicArtikelController::index');
    $routes->get('artikel/(:any)', 'PublicArtikelController::show/$1');

    $routes->get('laporan/create', 'LaporanController::create');
    $routes->post('laporan/store', 'LaporanController::store');
});

// Admin Routes
$routes->group('admin', ['filter' => 'auth'], function ($routes) {

    // Dashboard
    $routes->get('dashboard', 'Admin\Dashboard::index');

    // User Management Routes
    $routes->group('users', function ($routes) {
        $routes->get('/', 'Admin\UserController::index');
        $routes->get('create', 'Admin\UserController::create');
        $routes->post('store', 'Admin\UserController::store');
        $routes->get('edit/(:num)', 'Admin\UserController::edit/$1');
        $routes->post('update/(:num)', 'Admin\UserController::update/$1');
        $routes->post('delete/(:num)', 'Admin\UserController::delete/$1');
        $routes->get('toggle-status/(:num)', 'Admin\UserController::toggleStatus/$1');
    });

    // Kegiatan Management Routes
    $routes->group('kegiatan', function ($routes) {
        $routes->get('/', 'Admin\KegiatanController::index');
        $routes->get('create', 'Admin\KegiatanController::create');
        $routes->post('store', 'Admin\KegiatanController::store');
        $routes->get('show/(:segment)', 'Admin\KegiatanController::show/$1');
        $routes->get('edit/(:num)', 'Admin\KegiatanController::edit/$1');
        $routes->post('update/(:num)', 'Admin\KegiatanController::update/$1');
        $routes->delete('delete/(:num)', 'Admin\KegiatanController::delete/$1');


        $routes->post('uploadImage', 'Admin\KegiatanController::uploadImage');
    });

    $routes->group('artikel', function ($routes) {
        $routes->get('/', 'Admin\ArtikelController::index');
        $routes->post('update-status/(:num)', 'Admin\ArtikelController::updateStatus/$1');
        $routes->get('show/(:num)', 'Admin\ArtikelController::show/$1');
    });

    // Laporan Management Routes
    $routes->get('laporan', 'Admin\LaporanController::index');
    $routes->get('laporan/show/(:num)', 'Admin\LaporanController::show/$1');
    $routes->post('laporan/update-status/(:num)', 'Admin\LaporanController::updateStatus/$1');
    $routes->post('laporan/delete/(:num)', 'Admin\LaporanController::delete/$1');
});

// User Routes
$routes->group('user', ['filter' => 'auth'], function ($routes) {
    $routes->get('dashboard', 'User\Dashboard::index');

    $routes->get('profile', 'User\ProfilController::index');
    $routes->post('profile/update', 'User\ProfilController::update');
    $routes->post('profile/updatePassword', 'User\ProfilController::updatePassword');

    // Artikel Routes
    $routes->group('artikel', function ($routes) {
        $routes->get('/', 'User\ArtikelController::index');
        $routes->get('create', 'User\ArtikelController::create');
        $routes->post('store', 'User\ArtikelController::store');

        $routes->get('edit/(:num)', 'User\ArtikelController::edit/$1');
        $routes->post('update/(:num)', 'User\ArtikelController::update/$1');
        $routes->post('delete/(:num)', 'User\ArtikelController::delete/$1');

        $routes->get('show/(:segment)', 'User\ArtikelController::show/$1');
    });
});
