<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');

// Login Routes
$routes->get('login', 'AuthController::index');
$routes->post('login', 'AuthController::login');

$routes->get('logout', 'AuthController::logout');

// Password Reset Routes
$routes->get('forgot-password', 'AuthController::forgotPassword');
$routes->post('send-reset-link', 'AuthController::sendResetLink');
$routes->get('reset-password/(:any)', 'AuthController::resetPassword/$1');
$routes->post('update-password', 'AuthController::updatePassword');

$routes->group('', function ($routes) {
    // Halaman Profil
    $routes->get('profil/sejarah', 'Home::sejarah');
    $routes->get('profil/struktur', 'Home::struktur');
    $routes->get('profil/visimisi', 'Home::visimisi');

    // Halaman Peraturan (Rute Statis)
    $routes->get('peraturan/akuntansi-keuangan', 'Home::peraturan_akuntansi_keuangan');
    $routes->get('peraturan/hukum', 'Home::peraturan_hukum');
    $routes->get('peraturan/manajemen-sdm', 'Home::peraturan_manajemen_sdm');
    $routes->get('peraturan/manajemen-aset', 'Home::peraturan_manajemen_aset');
    $routes->get('peraturan/ketatalaksanaan', 'Home::peraturan_ketatalaksanaan');

    // Halaman Kegiatan & Laporan
    $routes->get('kegiatan', 'PublicKegiatanController::index');
    $routes->get('kegiatan/(:any)', 'PublicKegiatanController::show/$1');
    
    $routes->get('artikel', 'PublicArtikelController::index');
    $routes->get('artikel/(:any)', 'PublicArtikelController::show/$1');

    $routes->get('laporan/create', 'LaporanController::create');
    $routes->post('laporan/store', 'LaporanController::store');
    
    // Search Route
    $routes->get('search', 'SearchController::index');
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
        $routes->post('update-status/(:num)', 'Admin\KegiatanController::updateStatus/$1');
        $routes->get('create', 'Admin\KegiatanController::create');
        $routes->post('store', 'Admin\KegiatanController::store');
        $routes->get('show/(:segment)', 'Admin\KegiatanController::show/$1');
        $routes->get('edit/(:num)', 'Admin\KegiatanController::edit/$1');
        $routes->post('update/(:num)', 'Admin\KegiatanController::update/$1');
        $routes->delete('delete/(:num)', 'Admin\KegiatanController::delete/$1');

        $routes->post('uploadImage', 'Admin\KegiatanController::uploadImage');
    });

    // Artikel Management Routes
    $routes->group('artikel', function ($routes) {
        $routes->get('/', 'Admin\ArtikelController::index');
        $routes->post('update-status/(:num)', 'Admin\ArtikelController::updateStatus/$1');
        $routes->get('show/(:num)', 'Admin\ArtikelController::show/$1');
        $routes->get('delete/(:num)', 'Admin\ArtikelController::delete/$1');
    });

    // Laporan Management Routes
    $routes->group('laporan', function ($routes) {
        $routes->get('', 'Admin\LaporanController::index');
        $routes->get('show/(:num)', 'Admin\LaporanController::show/$1');
        $routes->post('update-status/(:num)', 'Admin\LaporanController::updateStatus/$1');
        $routes->post('delete/(:num)', 'Admin\LaporanController::delete/$1');
    });
   
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

    // Kegiatan Management Routes
    $routes->group('kegiatan', function ($routes) {
        $routes->get('/', 'User\KegiatanController::index');
        $routes->get('create', 'User\KegiatanController::create');
        $routes->post('store', 'User\KegiatanController::store');
        $routes->get('show/(:segment)', 'User\KegiatanController::show/$1');
        $routes->get('edit/(:num)', 'User\KegiatanController::edit/$1');
        $routes->post('update/(:num)', 'User\KegiatanController::update/$1');
        $routes->delete('delete/(:num)', 'User\KegiatanController::delete/$1');

        $routes->post('uploadImage', 'User\KegiatanController::uploadImage');
    });

    // Laporan Management Routes
    $routes->group('laporan', function ($routes) {
        $routes->get('', 'User\LaporanController::index');
        $routes->get('show/(:num)', 'User\LaporanController::show/$1');
        $routes->post('update-status/(:num)', 'User\LaporanController::updateStatus/$1');
        $routes->post('delete/(:num)', 'User\LaporanController::delete/$1');
    });
});