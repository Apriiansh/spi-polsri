<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data['users'] = $this->userModel->findAll();

        return view('user/index', $data);
    }

    public function dashboard()
    {
        // Pastikan pengguna sudah login
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('login'));
        }

        // Muat view dashboard pengguna
        return view('user/dashboard');
    }
}
