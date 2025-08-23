<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AdminController extends BaseController
{
    public function dashboard()
    {
        // Pastikan pengguna sudah login dan memiliki peran 'admin'
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return redirect()->to(base_url('login'));
        }

        // Muat view dashboard admin
        return view('admin/dashboard');
    }
}
