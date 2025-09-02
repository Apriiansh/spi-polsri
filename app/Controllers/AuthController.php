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
    protected $email;

    public function __construct()
    {
        $this->userModel = new UserModel();
        helper(['form', 'url']);
        $this->email = \Config\Services::email();
    }

    public function index()
    {
        return view('auth/login');
    }

    public function login()
    {
        $session = session();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $user = $this->userModel->where('username', $username)
            ->orWhere('email', $username)
            ->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $ses_data = [
                    'user_id'    => $user['id'],
                    'username'   => $user['username'],
                    'email'      => $user['email'],
                    'isLoggedIn' => TRUE,
                    'role'       => $user['role']
                ];
                $session->set($ses_data);

                if ($user['role'] == 'admin') {
                    return redirect()->to(site_url('admin/dashboard'));
                } else {
                    return redirect()->to(site_url('user/dashboard'));
                }
            } else {
                $session->setFlashdata('error', 'Password salah. Silakan coba lagi.');
                return redirect()->to(site_url('login'));
            }
        } else {
            $session->setFlashdata('error', 'Username atau email tidak ditemukan.');
            return redirect()->to(site_url('login'));
        }
    }

    public function forgotPassword()
    {
        return view('auth/forgot_password');
    }

    public function sendResetLink()
    {
        $session = session();
        $email = $this->request->getVar('email');
        $user = $this->userModel->findByEmail($email);

        if ($user) {
            $token = bin2hex(random_bytes(20));
            $expires = date('Y-m-d H:i:s', time() + 3600); // 1 hour

            $this->userModel->updateResetToken($user['id'], $token, $expires);

            $this->email->setTo($email);
            $this->email->setSubject('Reset Password');
            $this->email->setMessage('Klik link ini untuk mereset password Anda: ' . site_url('reset-password/' . $token));

            if ($this->email->send()) {
                $session->setFlashdata('success', 'Link reset password telah dikirim ke email Anda.');
            } else {
                $session->setFlashdata('error', 'Gagal mengirim email. Silakan coba lagi.');
            }
        } else {
            $session->setFlashdata('error', 'Email tidak ditemukan.');
        }

        return redirect()->to(site_url('forgot-password'));
    }

    public function resetPassword($token)
    {
        $user = $this->userModel->where('reset_token', $token)
            ->where('reset_expires >', date('Y-m-d H:i:s'))
            ->first();

        if ($user) {
            return view('auth/reset_password', ['token' => $token]);
        } else {
            session()->setFlashdata('error', 'Token reset password tidak valid atau telah kedaluwarsa.');
            return redirect()->to(site_url('forgot-password'));
        }
    }

    public function updatePassword()
    {
        $session = session();
        $token = $this->request->getVar('token');
        $password = $this->request->getVar('password');
        $user = $this->userModel->where('reset_token', $token)
            ->where('reset_expires >', date('Y-m-d H:i:s'))
            ->first();

        if ($user) {
            $this->userModel->updatePassword($user['id'], $password);
            $session->setFlashdata('success', 'Password Anda telah berhasil diubah. Silakan login.');
            return redirect()->to(site_url('login'));
        } else {
            $session->setFlashdata('error', 'Token reset password tidak valid atau telah kedaluwarsa.');
            return redirect()->to(site_url('forgot-password'));
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(site_url('login'));
    }
}
