<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\UserModel;

class ProfilController extends BaseController
{
    public function index()
    {
        $userId = session()->get('user_id');
        if (!$userId) {
            return redirect()->to('/login');
        }

        $userModel = new UserModel();
        $user = $userModel->find($userId);

        return view('user/profil/index', ['user' => $user]);
    }

    public function update()
    {
        $userId = session()->get('user_id');
        if (!$userId) {
            return redirect()->to('/login');
        }

        $userModel = new UserModel();

        $rules = [
            'username' => 'required|min_length[3]|max_length[50]',
            'email'    => 'required|valid_email'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'username' => $this->request->getVar('username'),
            'email'    => $this->request->getVar('email'),
        ];

        $userModel->update($userId, $data);

        session()->set('username', $data['username']); // Update session username

        return redirect()->to('/user/profile')->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword()
    {
        $userId = session()->get('user_id');
        if (!$userId) {
            return redirect()->to('/login');
        }

        $rules = [
            'old_password' => 'required',
            'new_password' => 'required|min_length[6]',
            'confirm_new_password' => 'required|matches[new_password]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('pw_errors', $this->validator->getErrors())->with('show_pw_tab', true);
        }

        $userModel = new UserModel();
        $user = $userModel->find($userId);

        if (!password_verify($this->request->getVar('old_password'), $user['password'])) {
            return redirect()->back()->withInput()->with('pw_errors', ['old_password' => 'Password lama salah'])->with('show_pw_tab', true);
        }

        $userModel->update($userId, [
            'password' => password_hash($this->request->getVar('new_password'), PASSWORD_DEFAULT)
        ]);

        return redirect()->to('/user/profile')->with('pw_success', 'Password berhasil diubah.')->with('show_pw_tab', true);
    }
}
