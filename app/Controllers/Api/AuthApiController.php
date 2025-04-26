<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\User;

class AuthApiController extends BaseController
{
    public function register()
    {
        $rules = [
            'email' => 'required|valid_email|is_unique[users.email]',
            'first_name' => 'required|min_length[1]',
            'last_name' => 'required|min_length[1]',
            'password' => 'required|min_length[8]',
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => 102,
                'message' => 'Validasi gagal',
                'errors' => $this->validator->getErrors()
            ])->setStatusCode(400);
        }

        $userModel = new User();
        $userModel->save([
            'email' => $this->request->getPost('email'),
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name'),
            'password' => $this->request->getPost('password'),
            'saldo' => 0
        ]);

        return $this->response->setJSON([
            'status' => 0,
            'message' => 'Registrasi berhasil',
            'redirect' => base_url('login')
        ])->setStatusCode(200);
    }

    public function login()
    {
        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => 102,
                'message' => 'Validasi gagal',
                'errors' => $this->validator->getErrors()
            ])->setStatusCode(400);
        }

        $userModel = new User();
        $user = $userModel->where('email', $this->request->getPost('email'))->first();

        if (!$user || !password_verify($this->request->getPost('password'), $user['password'])) {
            return $this->response->setJSON([
                'status' => 103,
                'message' => 'Email atau password salah'
            ])->setStatusCode(401);
        }

        // Set session user
        session()->set([
            'isLoggedIn' => true,
            'user' => [
                'id' => $user['id'],
                'first_name' => $user['first_name'],
                'last_name' => $user['last_name'],
                'email' => $user['email'],
                'saldo' => isset($user['saldo']) ? $user['saldo'] : 0
            ]
        ]);

        // Return success response with redirect URL
        unset($user['password']);
        return $this->response->setJSON([
            'status' => 0,
            'message' => 'Login Berhasil',
            'redirect' => base_url('/'),
            'user' => $user
        ])->setStatusCode(200);
    }

    public function logout()
    {
        // Destroy the session
        session()->destroy();
        
        // Return success response with redirect URL
        return $this->response->setJSON([
            'status' => 0,
            'message' => 'Logout Berhasil',
            'redirect' => base_url('login')
        ])->setStatusCode(200);
    }

    public function updateProfile()
    {
        // Check if user is logged in
        if (!session()->get('isLoggedIn')) {
            return $this->response->setJSON([
                'status' => 103,
                'message' => 'Unauthorized'
            ])->setStatusCode(401);
        }

        $rules = [
            'first_name' => 'required|min_length[1]',
            'last_name' => 'required|min_length[1]'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => 102,
                'message' => 'Validasi gagal',
                'errors' => $this->validator->getErrors()
            ])->setStatusCode(400);
        }

        $userModel = new User();
        $userId = session()->get('user.id');
        
        // Update user profile
        $userModel->update($userId, [
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name')
        ]);

        // Update session data
        $user = $userModel->find($userId);
        session()->set([
            'user' => [
                'id' => $user['id'],
                'first_name' => $user['first_name'],
                'last_name' => $user['last_name'],
                'email' => $user['email'],
                'saldo' => isset($user['saldo']) ? $user['saldo'] : 0
            ]
        ]);

        return $this->response->setJSON([
            'status' => 0,
            'message' => 'Profil berhasil diperbarui',
            'user' => [
                'first_name' => $user['first_name'],
                'last_name' => $user['last_name'],
                'email' => $user['email']
            ]
        ])->setStatusCode(200);
    }

    public function getProfile()
    {
        if (!session()->get('isLoggedIn')) {
            return $this->response->setJSON([
                'status' => 103,
                'message' => 'Unauthorized'
            ])->setStatusCode(401);
        }
        $user = session()->get('user');
        return $this->response->setJSON([
            'status' => 0,
            'message' => 'Data profil berhasil diambil',
            'user' => $user
        ])->setStatusCode(200);
    }
}
