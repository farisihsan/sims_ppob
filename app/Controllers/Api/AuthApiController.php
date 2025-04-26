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
                'status' => false,
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
            'status' => true,
            'message' => 'Registrasi berhasil'
        ]);
    }

    public function login()
    {
        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Validasi gagal',
                'errors' => $this->validator->getErrors()
            ])->setStatusCode(400);
        }

        $userModel = new User();
        $user = $userModel->where('email', $this->request->getPost('email'))->first();

        if (!$user || !password_verify($this->request->getPost('password'), $user['password'])) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Email atau password salah'
            ])->setStatusCode(401);
        }

        // Contoh: return data user (tanpa password)
        unset($user['password']);
        return $this->response->setJSON([
            'status' => true,
            'message' => 'Login berhasil',
            'user' => $user
        ]);
    }
}
