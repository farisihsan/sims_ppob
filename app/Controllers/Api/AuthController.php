<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\User;
use CodeIgniter\API\ResponseTrait;

class AuthController extends ResourceController
{
    use ResponseTrait;
    function __construct(){
        $this->model = new User();
    }
    public function register()
    {
        return view('auth/register');
    }
    public function login()
    {
        return view('auth/login');
    }

    public function submitLogin()
    {
        $data = [
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
        ];

        $user = $this->model->where('email', $data['email'])->first();
        if (!$user) {
            return $this->failUnauthorized('Email tidak ditemukan');
        }

        if (!password_verify($data['password'], $user['password'])) {
            return $this->failUnauthorized('Password salah');
        }
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
        // $response = [
        //     'status' => 'success',
        //     'error' => null,
        //     'messages' => [
        //         'success' => 'Berhasil Login'
        //     ]
        // ];
        return redirect()->to(base_url('/'));
    }

    
    public function submitRegistration(){
        $data =[
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name'),
            'confirm_password' => $this->request->getPost('confirm_password'),
        ];
        // $this->model->save($data);
        if(!$this->model->save($data)){
            return $this->fail($this->model->errors());
        }
        // $response = [
        //     'status' => 'success',
        //     'error' => null,
        //     'messages' => [
        //         'success' => 'Berhasil membuat akun'
        //     ]
        // ];
        return redirect()->to(base_url('/login'));
        
        
    }
    public function uploadPhoto()
    {
        $user = session()->get('user');
        $id = $user['id'];

        $file = $this->request->getFile('photo');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/profile', $newName);

            // Update database
            $this->model->update($id, [
                'photo' => '/uploads/profile/' . $newName
            ]);

            // Update session
            $user['photo'] = '/uploads/profile/' . $newName;
            session()->set('user', $user);

            return redirect()->to(base_url('/profile'))->with('message', 'Foto profil berhasil diupload');
        } else {
            return redirect()->back()->with('error', 'Gagal upload foto');
        }
    }

    public function updateProfile()
    {
        $user = session()->get('user');
        $id = $user['id'];

        // Ambil data baru dari form
        $first_name = $this->request->getPost('first_name');
        $last_name = $this->request->getPost('last_name');

        // Update ke database
        $this->model->update($id, [
            'first_name' => $first_name,
            'last_name' => $last_name
        ]);

        // Update session
        $user['first_name'] = $first_name;
        $user['last_name'] = $last_name;
        session()->set('user', $user);

        return redirect()->to(base_url('/profile'))->with('message', 'Berhasil mengubah profil');
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/login'))->with('message', 'Berhasil logout');
    }
    

}
