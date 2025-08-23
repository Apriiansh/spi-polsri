<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    /**
     * @var \App\Models\UserModel
     */
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        // Helpers like 'url' and 'form' can be loaded here if needed
        helper(['form', 'url']);
    }

    /**
     * Display the login form.
     */
    public function index()
    {
        // This method shows the login form.
        // It uses the view created previously.
        return view('auth/login');
    }

    /**
     * Handle the login request and authenticate the user.
     */
    public function login()
    {
        $session = session();

        // Get data from the login form
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        // Find the user by username or email
        $user = $this->userModel->where('username', $username)
            ->orWhere('email', $username)
            ->first();

        // Check if user exists and password is correct
        if ($user) {
            // Check if password matches
            if (password_verify($password, $user['password'])) {
                // Password is correct, set session data
                $ses_data = [
                    'user_id'    => $user['id'],
                    'username'   => $user['username'],
                    'email'      => $user['email'],
                    'isLoggedIn' => TRUE,
                    'role'       => $user['role'] // Assuming 'role' is a column in your 'users' table
                ];
                $session->set($ses_data);

                // Redirect based on user role
                if ($user['role'] == 'admin') {
                    return redirect()->to(site_url('admin/dashboard'));
                } else {
                    return redirect()->to(site_url('user/dashboard'));
                }
            } else {
                // Incorrect password
                $session->setFlashdata('error', 'Password salah. Silakan coba lagi.');
                return redirect()->to(site_url('login'));
            }
        } else {
            // User not found
            $session->setFlashdata('error', 'Username atau email tidak ditemukan.');
            return redirect()->to(site_url('login'));
        }
    }

    /**
     * Handle user logout.
     */
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(site_url('login'));
    }
}
