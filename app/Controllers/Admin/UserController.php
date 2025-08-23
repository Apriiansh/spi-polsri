<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{

    protected $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    } 

    public function index()
    {
        $search = $this->request->getVar('search');
        $role = $this->request->getVar('role');
        $status = $this->request->getVar('status');

        $builder = $this->userModel;

        // Filters
        if($search) {
            $builder = $builder
                ->groupStart()
                ->like('username', $search)
                ->orLike('email', $search)
                ->groupEnd();
        }

        if($role) {
            $builder  =$builder->where('role', $role);
        }

        if($status != null && $status != '') {
            $builder  =$builder->where('status', $status);
        }

        $data = [
            'title' => 'Manajemen User',
            'users' => $builder->orderBy('created_at', 'DESC')->paginate(10),
            'pager' => $this->userModel->pager, 
            'search' => $search,
            'role' => $role,
            'status' => $status,
        ];

        return view('admin/users/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah User',
            'validation' => \Config\Services::validation(),
        ];

        return view('admin/users/create', $data);
    }

    public function store()
    {
        $rules = [
            'username' => 'required|min_length[3]|max_length[50]|is_unique[users.username]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'role' => 'required|in_list[admin,user]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => $this->request->getPost('role'),
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
        ];

        if ($this->userModel->insert($data)) {
            return redirect()->to('/admin/users')->with('success', 'User berhasil ditambahkan');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal menambahkan user');
    }

    public function edit($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            return redirect()->to('/admin/users')->with('error', 'User tidak ditemukan');
        }

        $data = [
            'title' => 'Edit User',
            'user' => $user,
            'validation' => \Config\Services::validation(),
        ];

        return view('admin/users/edit', $data);
    }

    public function update($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            return redirect()->to('/admin/users')->with('error', 'User tidak ditemukan');
        }

        $rules = [
            'username' => "required|min_length[3]|max_length[50]|is_unique[users.username,id,$id]",
            'email' => "required|valid_email|is_unique[users.email,id,$id]",
            'role' => 'required|in_list[admin,user]',
        ];

        if ($this->request->getPost('password')) {
            $rules['password'] = 'min_length[6]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'role' => $this->request->getPost('role'),
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
        ];

        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        if ($this->userModel->update($id, $data)) {
            return redirect()->to('/admin/users')->with('success', 'User berhasil diupdate');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal mengupdate user');
    }

    public function delete($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            return redirect()->to('/admin/users')->with('error', 'User tidak ditemukan');
        }

        if ($this->userModel->delete($id)) {
            return redirect()->to('/admin/users')->with('success', 'User berhasil dihapus');
        }

        return redirect()->to('/admin/users')->with('error', 'Gagal menghapus user');
    }

    public function toggleStatus($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            return redirect()->to('/admin/users')->with('error', 'User tidak ditemukan');
        }

        $newStatus = $user['is_active'] ? 0 : 1;

        if ($this->userModel->update($id, ['is_active' => $newStatus])) {
            $status = $newStatus ? 'diaktifkan' : 'dinonaktifkan';
            return redirect()->to('/admin/users')->with('success', "User berhasil $status");
        }

        return redirect()->to('/admin/users')->with('error', 'Gagal mengubah status user');
    }
}