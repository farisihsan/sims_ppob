<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth/register');
    }

    public function login()
    {
        return view('auth/login');
    }

    public function processRegister()
    {
        $rules = [
            'email' => 'required|valid_email|is_unique[users.email]',
            'first_name' => 'required|min_length[1]',
            'last_name' => 'required|min_length[1]',
            'password' => 'required|min_length[8]',
            'confirm_password' => 'required|matches[password]'
        ];

        if (!$this->validate($rules)) {
            return view('auth/register', [
                'validation' => $this->validator
            ]);
        }

        $userModel = new \App\Models\User();
        $userModel->save([
            'email' => $this->request->getPost('email'),
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name'),
            'password' => $this->request->getPost('password'),
            'saldo' => 0
        ]);

        return redirect()->to(base_url('login'))->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function processLogin()
    {
        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required'
        ];

        if (!$this->validate($rules)) {
            return view('auth/login', [
                'validation' => $this->validator
            ]);
        }

        $userModel = new \App\Models\User();
        $user = $userModel->where('email', $this->request->getPost('email'))->first();

        if (!$user || !password_verify($this->request->getPost('password'), $user['password'])) {
            return view('auth/login', [
                'validation' => $this->validator,
                'error' => 'Email atau password salah'
            ]);
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

        // Redirect ke halaman utama
        return redirect()->to(base_url('/'));
    }

    public function logout()
    {
        
        return redirect()->to(base_url('login'));
    }
} 