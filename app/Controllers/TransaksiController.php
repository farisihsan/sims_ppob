<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\Transaction;
use App\Models\User;

class TransaksiController extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        //
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function topup()
    {
        $user = session()->get('user');
        if (!$user) {
            return $this->failUnauthorized('User tidak ditemukan.');
        }
        $nominal = $this->request->getVar('nominal');
        if (!$nominal || $nominal < 10000) {
            return $this->failValidationErrors('Nominal minimal 10.000');
        }

        $invoice_number = 'INV' . strtoupper(bin2hex(random_bytes(5)));
        $transactionModel = new Transaction();
        $userModel = new User();

        // Simpan transaksi
        $data = [
            'invoice_number'    => $invoice_number,
            'user_id'           => $user['id'],
            'service_code'      => 'TOP_UP',
            'service_name'      => 'Top Up',
            'transaction_type'  => 'TOPUP',
            'total_amount'      => $nominal,
            'created_on'        => date('Y-m-d H:i:s'),
        ];
        $transactionModel->insert($data);

        // Update saldo user
        $userData = $userModel->find($user['id']);
        if (!$userData) {
            return $this->failNotFound('User tidak ditemukan.');
        }
        $userModel->update($user['id'], [
            'saldo' => $userData['saldo'] + $nominal
        ]);

        // Update session saldo
        $user['saldo'] = $userData['saldo'] + $nominal;
        session()->set('user', $user);

        // Kembalikan response JSON
        return $this->respond([
            'status' => 'success',
            'message' => 'Top up berhasil',
            'invoice_number' => $invoice_number,
            'saldo' => $user['saldo']
        ]);
    }
    public function pbb(){
        $user = session()->get('user');
        if (!$user) {
            return $this->failUnauthorized('User tidak ditemukan.');
        }
        $nominal = $this->request->getVar('nominal');

        $userModel = new User();
        $userData = $userModel->find($user['id']);
        if (!$userData) {
            return $this->failNotFound('User tidak ditemukan.');
        }

        // Cek saldo dari database, bukan dari session
        if ($nominal > $userData['saldo']) {
            return $this->failValidationErrors('Saldo tidak cukup');
        }

        $invoice_number = 'INV' . strtoupper(bin2hex(random_bytes(5)));
        $transactionModel = new Transaction();

        // Simpan transaksi
        $data = [
            'invoice_number'    => $invoice_number,
            'user_id'           => $user['id'],
            'service_code'      => 'PBB',
            'service_name'      => 'Pembayaran PBB',
            'transaction_type'  => 'PAYMENT',
            'total_amount'      => $nominal,
            'created_on'        => date('Y-m-d H:i:s'),
        ];
        $transactionModel->insert($data);

        // Update saldo user di database
        $userModel->update($user['id'], [
            'saldo' => $userData['saldo'] - $nominal
        ]);

        // Update session saldo
        $user['saldo'] = $userData['saldo'] - $nominal;
        session()->set('user', $user);

        // Kembalikan response JSON
        return $this->respond([
            'status' => 'success',
            'message' => 'Pembayaran PBB berhasil',
            'invoice_number' => $invoice_number,
            'saldo' => $user['saldo']
        ]);
    }
    public function listrik(){
        $user = session()->get('user');
        if (!$user) {
            return $this->failUnauthorized('User tidak ditemukan.');
        }
        $nominal = $this->request->getVar('nominal');

        $userModel = new User();
        $userData = $userModel->find($user['id']);
        if (!$userData) {
            return $this->failNotFound('User tidak ditemukan.');
        }

        // Cek saldo dari database, bukan dari session
        if ($nominal > $userData['saldo']) {
            return $this->failValidationErrors('Saldo tidak cukup');
        }

        $invoice_number = 'INV' . strtoupper(bin2hex(random_bytes(5)));
        $transactionModel = new Transaction();

        // Simpan transaksi
        $data = [
            'invoice_number'    => $invoice_number,
            'user_id'           => $user['id'],
            'service_code'      => 'LISTRIK',
            'service_name'      => 'Pembayaran Listrik',
            'transaction_type'  => 'PAYMENT',
            'total_amount'      => $nominal,
            'created_on'        => date('Y-m-d H:i:s'),
        ];
        $transactionModel->insert($data);

        // Update saldo user di database
        $userModel->update($user['id'], [
            'saldo' => $userData['saldo'] - $nominal
        ]);

        // Update session saldo
        $user['saldo'] = $userData['saldo'] - $nominal;
        session()->set('user', $user);

        // Kembalikan response JSON
        return $this->respond([
            'status' => 'success',
            'message' => 'Pembayaran listrik berhasil',
            'invoice_number' => $invoice_number,
            'saldo' => $user['saldo']
        ]);
    }
    public function pulsa(){
        $user = session()->get('user');
        if (!$user) {
            return $this->failUnauthorized('User tidak ditemukan.');
        }
        $nominal = $this->request->getVar('nominal');

        $userModel = new User();
        $userData = $userModel->find($user['id']);
        if (!$userData) {
            return $this->failNotFound('User tidak ditemukan.');
        }

        // Cek saldo dari database, bukan dari session
        if ($nominal > $userData['saldo']) {
            return $this->failValidationErrors('Saldo tidak cukup');
        }

        $invoice_number = 'INV' . strtoupper(bin2hex(random_bytes(5)));
        $transactionModel = new Transaction();

        // Simpan transaksi
        $data = [
            'invoice_number'    => $invoice_number,
            'user_id'           => $user['id'],
            'service_code'      => 'PULSA',
            'service_name'      => 'Pembayaran pulsa',
            'transaction_type'  => 'PAYMENT',
            'total_amount'      => $nominal,
            'created_on'        => date('Y-m-d H:i:s'),
        ];
        $transactionModel->insert($data);

        // Update saldo user di database
        $userModel->update($user['id'], [
            'saldo' => $userData['saldo'] - $nominal
        ]);

        // Update session saldo
        $user['saldo'] = $userData['saldo'] - $nominal;
        session()->set('user', $user);

        // Kembalikan response JSON
        return $this->respond([
            'status' => 'success',
            'message' => 'Pembayaran pulsa berhasil',
            'invoice_number' => $invoice_number,
            'saldo' => $user['saldo']
        ]);
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        //
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        //
    }
}
