<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'email',
        'first_name',
        'last_name',
        'password',
        'saldo'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at'; 

    // Validation
    protected $validationRules = [
        'email' => [
            'rules' => 'required|valid_email|is_unique[users.email,id,{id}]',
            'errors' => [
                'required' => 'Email harus diisi',
                'valid_email' => 'Email tidak valid',
                'is_unique' => 'Email sudah terdaftar'
            ]
        ],
        'first_name' => [
            'rules' => 'required|min_length[1]',
            'errors' => [
                'required' => 'Nama depan harus diisi',
                'min_length' => 'Nama depan minimal 1 karakter'
            ]
        ],
        'last_name' => [
            'rules' => 'required|min_length[1]',
            'errors' => [
                'required' => 'Nama belakang harus diisi',
                'min_length' => 'Nama belakang minimal 1 karakter'
            ]
        ],
        'password' => [
            'rules' => 'required|min_length[8]',
            'errors' => [
                'required' => 'Password harus diisi',
                'min_length' => 'Password minimal 8 karakter'
            ]
        ]
    ];

    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['hashPassword'];
    protected $beforeUpdate   = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (!isset($data['data']['password'])) {
            return $data;
        }

        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_BCRYPT);
        return $data;
    }
}
