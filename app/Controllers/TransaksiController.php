<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\Transaction;
use App\Models\User;

class TransaksiController extends ResourceController
{
    protected $timezone;

    public function __construct()
    {
        $this->timezone = new \DateTimeZone('Asia/Jakarta');
    }

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

        
        $data = [
            'invoice_number'    => $invoice_number,
            'user_id'           => $user['id'],
            'service_code'      => 'TOP_UP',
            'service_name'      => 'Top Up',
            'transaction_type'  => 'TOPUP',
            'total_amount'      => $nominal,
            'created_on'        => (new \DateTime('now', $this->timezone))->format('Y-m-d H:i:s'),
        ];
        $transactionModel->insert($data);

        
        $userData = $userModel->find($user['id']);
        if (!$userData) {
            return $this->failNotFound('User tidak ditemukan.');
        }
        $userModel->update($user['id'], [
            'saldo' => $userData['saldo'] + $nominal
        ]);

        
        $user['saldo'] = $userData['saldo'] + $nominal;
        session()->set('user', $user);

        
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

        
        if ($nominal > $userData['saldo']) {
            return $this->failValidationErrors('Saldo tidak cukup');
        }

        $invoice_number = 'INV' . strtoupper(bin2hex(random_bytes(5)));
        $transactionModel = new Transaction();

        
        $data = [
            'invoice_number'    => $invoice_number,
            'user_id'           => $user['id'],
            'service_code'      => 'PBB',
            'service_name'      => 'Pembayaran PBB',
            'transaction_type'  => 'PAYMENT',
            'total_amount'      => $nominal,
            'created_on'        => (new \DateTime('now', $this->timezone))->format('Y-m-d H:i:s'),
        ];
        $transactionModel->insert($data);

        
        $userModel->update($user['id'], [
            'saldo' => $userData['saldo'] - $nominal
        ]);

        
        $user['saldo'] = $userData['saldo'] - $nominal;
        session()->set('user', $user);

        
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

        
        if ($nominal > $userData['saldo']) {
            return $this->failValidationErrors('Saldo tidak cukup');
        }

        $invoice_number = 'INV' . strtoupper(bin2hex(random_bytes(5)));
        $transactionModel = new Transaction();

        
        $data = [
            'invoice_number'    => $invoice_number,
            'user_id'           => $user['id'],
            'service_code'      => 'LISTRIK',
            'service_name'      => 'Pembayaran Listrik',
            'transaction_type'  => 'PAYMENT',
            'total_amount'      => $nominal,
            'created_on'        => (new \DateTime('now', $this->timezone))->format('Y-m-d H:i:s'),
        ];
        $transactionModel->insert($data);

        
        $userModel->update($user['id'], [
            'saldo' => $userData['saldo'] - $nominal
        ]);

        
        $user['saldo'] = $userData['saldo'] - $nominal;
        session()->set('user', $user);

        
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

        
        if ($nominal > $userData['saldo']) {
            return $this->failValidationErrors('Saldo tidak cukup');
        }

        $invoice_number = 'INV' . strtoupper(bin2hex(random_bytes(5)));
        $transactionModel = new Transaction();

        
        $data = [
            'invoice_number'    => $invoice_number,
            'user_id'           => $user['id'],
            'service_code'      => 'PULSA',
            'service_name'      => 'Pembayaran pulsa',
            'transaction_type'  => 'PAYMENT',
            'total_amount'      => $nominal,
            'created_on'        => (new \DateTime('now', $this->timezone))->format('Y-m-d H:i:s'),
        ];
        $transactionModel->insert($data);

        
        $userModel->update($user['id'], [
            'saldo' => $userData['saldo'] - $nominal
        ]);

        
        $user['saldo'] = $userData['saldo'] - $nominal;
        session()->set('user', $user);

        
        return $this->respond([
            'status' => 'success',
            'message' => 'Pembayaran pulsa berhasil',
            'invoice_number' => $invoice_number,
            'saldo' => $user['saldo']
        ]);
    }
    
    public function pdam(){
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

        
        if ($nominal > $userData['saldo']) {
            return $this->failValidationErrors('Saldo tidak cukup');
        }

        $invoice_number = 'INV' . strtoupper(bin2hex(random_bytes(5)));
        $transactionModel = new Transaction();

        
        $data = [
            'invoice_number'    => $invoice_number,
            'user_id'           => $user['id'],
            'service_code'      => 'PDAM',
            'service_name'      => 'Pembayaran PDAM',
            'transaction_type'  => 'PAYMENT',
            'total_amount'      => $nominal,
            'created_on'        => (new \DateTime('now', $this->timezone))->format('Y-m-d H:i:s'),
        ];
        $transactionModel->insert($data);

        
        $userModel->update($user['id'], [
            'saldo' => $userData['saldo'] - $nominal
        ]);

        
        $user['saldo'] = $userData['saldo'] - $nominal;
        session()->set('user', $user);

        
        return $this->respond([
            'status' => 'success',
            'message' => 'Pembayaran PDAM berhasil',
            'invoice_number' => $invoice_number,
            'saldo' => $user['saldo']
        ]);
    }
    
    public function pgn(){
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

        
        if ($nominal > $userData['saldo']) {
            return $this->failValidationErrors('Saldo tidak cukup');
        }

        $invoice_number = 'INV' . strtoupper(bin2hex(random_bytes(5)));
        $transactionModel = new Transaction();

        
        $data = [
            'invoice_number'    => $invoice_number,
            'user_id'           => $user['id'],
            'service_code'      => 'PGN',
            'service_name'      => 'Pembayaran PGN',
            'transaction_type'  => 'PAYMENT',
            'total_amount'      => $nominal,
            'created_on'        => (new \DateTime('now', $this->timezone))->format('Y-m-d H:i:s'),
        ];
        $transactionModel->insert($data);

        
        $userModel->update($user['id'], [
            'saldo' => $userData['saldo'] - $nominal
        ]);

        
        $user['saldo'] = $userData['saldo'] - $nominal;
        session()->set('user', $user);

        
        return $this->respond([
            'status' => 'success',
            'message' => 'Pembayaran PGN berhasil',
            'invoice_number' => $invoice_number,
            'saldo' => $user['saldo']
        ]);
    }
    public function tv_langganan(){
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

        
        if ($nominal > $userData['saldo']) {
            return $this->failValidationErrors('Saldo tidak cukup');
        }

        $invoice_number = 'INV' . strtoupper(bin2hex(random_bytes(5)));
        $transactionModel = new Transaction();

        
        $data = [
            'invoice_number'    => $invoice_number,
            'user_id'           => $user['id'],
            'service_code'      => 'TV_LANGGANAN',
            'service_name'      => 'Pembayaran TV Langganan',
            'transaction_type'  => 'PAYMENT',
            'total_amount'      => $nominal,
            'created_on'        => (new \DateTime('now', $this->timezone))->format('Y-m-d H:i:s'),
        ];
        $transactionModel->insert($data);

        
        $userModel->update($user['id'], [
            'saldo' => $userData['saldo'] - $nominal
        ]);

        
        $user['saldo'] = $userData['saldo'] - $nominal;
        session()->set('user', $user);

        
        return $this->respond([
            'status' => 'success',
            'message' => 'Pembayaran TV Langganan berhasil',
            'invoice_number' => $invoice_number,
            'saldo' => $user['saldo']
        ]);
    }
    public function musik(){
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

        
        if ($nominal > $userData['saldo']) {
            return $this->failValidationErrors('Saldo tidak cukup');
        }

        $invoice_number = 'INV' . strtoupper(bin2hex(random_bytes(5)));
        $transactionModel = new Transaction();

        
        $data = [
            'invoice_number'    => $invoice_number,
            'user_id'           => $user['id'],
            'service_code'      => 'MUSIK',
            'service_name'      => 'Pembayaran Musik',
            'transaction_type'  => 'PAYMENT',
            'total_amount'      => $nominal,
            'created_on'        => (new \DateTime('now', $this->timezone))->format('Y-m-d H:i:s'),
        ];
        $transactionModel->insert($data);

        
        $userModel->update($user['id'], [
            'saldo' => $userData['saldo'] - $nominal
        ]);

        
        $user['saldo'] = $userData['saldo'] - $nominal;
        session()->set('user', $user);

        
        return $this->respond([
            'status' => 'success',
            'message' => 'Pembayaran Musik berhasil',
            'invoice_number' => $invoice_number,
            'saldo' => $user['saldo']
        ]);
    }
    public function voucher_game(){
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

        
        if ($nominal > $userData['saldo']) {
            return $this->failValidationErrors('Saldo tidak cukup');
        }

        $invoice_number = 'INV' . strtoupper(bin2hex(random_bytes(5)));
        $transactionModel = new Transaction();

        
        $data = [
            'invoice_number'    => $invoice_number,
            'user_id'           => $user['id'],
            'service_code'      => 'VOUCHER_GAME',
            'service_name'      => 'Pembayaran Voucher Game',
            'transaction_type'  => 'PAYMENT',
            'total_amount'      => $nominal,
            'created_on'        => (new \DateTime('now', $this->timezone))->format('Y-m-d H:i:s'),
        ];
        $transactionModel->insert($data);

        
        $userModel->update($user['id'], [
            'saldo' => $userData['saldo'] - $nominal
        ]);

        
        $user['saldo'] = $userData['saldo'] - $nominal;
        session()->set('user', $user);

        
        return $this->respond([
            'status' => 'success',
            'message' => 'Pembayaran Voucher Game berhasil',
            'invoice_number' => $invoice_number,
            'saldo' => $user['saldo']
        ]);
    }
    public function voucher_makanan(){
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

        
        if ($nominal > $userData['saldo']) {
            return $this->failValidationErrors('Saldo tidak cukup');
        }

        $invoice_number = 'INV' . strtoupper(bin2hex(random_bytes(5)));
        $transactionModel = new Transaction();

        
        $data = [
            'invoice_number'    => $invoice_number,
            'user_id'           => $user['id'],
            'service_code'      => 'VOUCHER_MAKANAN',
            'service_name'      => 'Pembayaran Voucher Makanan',
            'transaction_type'  => 'PAYMENT',
            'total_amount'      => $nominal,
            'created_on'        => (new \DateTime('now', $this->timezone))->format('Y-m-d H:i:s'),
        ];
        $transactionModel->insert($data);

        
        $userModel->update($user['id'], [
            'saldo' => $userData['saldo'] - $nominal
        ]);

        
        $user['saldo'] = $userData['saldo'] - $nominal;
        session()->set('user', $user);

        
        return $this->respond([
            'status' => 'success',
            'message' => 'Pembayaran Voucher Makanan berhasil',
            'invoice_number' => $invoice_number,
            'saldo' => $user['saldo']
        ]);
    }
    public function kurban(){
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

        
        if ($nominal > $userData['saldo']) {
            return $this->failValidationErrors('Saldo tidak cukup');
        }

        $invoice_number = 'INV' . strtoupper(bin2hex(random_bytes(5)));
        $transactionModel = new Transaction();

        
        $data = [
            'invoice_number'    => $invoice_number,
            'user_id'           => $user['id'],
            'service_code'      => 'KURBAN',
            'service_name'      => 'Pembayaran Kurban',
            'transaction_type'  => 'PAYMENT',
            'total_amount'      => $nominal,
            'created_on'        => (new \DateTime('now', $this->timezone))->format('Y-m-d H:i:s'),
        ];
        $transactionModel->insert($data);

        
        $userModel->update($user['id'], [
            'saldo' => $userData['saldo'] - $nominal
        ]);

        
        $user['saldo'] = $userData['saldo'] - $nominal;
        session()->set('user', $user);

        
        return $this->respond([
            'status' => 'success',
            'message' => 'Pembayaran Kurban berhasil',
            'invoice_number' => $invoice_number,
            'saldo' => $user['saldo']
        ]);
    }
    public function zakat(){
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

        
        if ($nominal > $userData['saldo']) {
            return $this->failValidationErrors('Saldo tidak cukup');
        }

        $invoice_number = 'INV' . strtoupper(bin2hex(random_bytes(5)));
        $transactionModel = new Transaction();

        
        $data = [
            'invoice_number'    => $invoice_number,
            'user_id'           => $user['id'],
            'service_code'      => 'ZAKAT',
            'service_name'      => 'Pembayaran Zakat',
            'transaction_type'  => 'PAYMENT',
            'total_amount'      => $nominal,
            'created_on'        => (new \DateTime('now', $this->timezone))->format('Y-m-d H:i:s'),
        ];
        $transactionModel->insert($data);

        
        $userModel->update($user['id'], [
            'saldo' => $userData['saldo'] - $nominal
        ]);

        
        $user['saldo'] = $userData['saldo'] - $nominal;
        session()->set('user', $user);

        
        return $this->respond([
            'status' => 'success',
            'message' => 'Pembayaran Zakat berhasil',
            'invoice_number' => $invoice_number,
            'saldo' => $user['saldo']
        ]);
    }
    public function paket_data(){
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

        
        if ($nominal > $userData['saldo']) {
            return $this->failValidationErrors('Saldo tidak cukup');
        }

        $invoice_number = 'INV' . strtoupper(bin2hex(random_bytes(5)));
        $transactionModel = new Transaction();

        
        $data = [
            'invoice_number'    => $invoice_number,
            'user_id'           => $user['id'],
            'service_code'      => 'PAKET_DATA',
            'service_name'      => 'Pembayaran Paket Data',
            'transaction_type'  => 'PAYMENT',
            'total_amount'      => $nominal,
            'created_on'        => (new \DateTime('now', $this->timezone))->format('Y-m-d H:i:s'),
        ];
        $transactionModel->insert($data);

        
        $userModel->update($user['id'], [
            'saldo' => $userData['saldo'] - $nominal
        ]);

        
        $user['saldo'] = $userData['saldo'] - $nominal;
        session()->set('user', $user);

        
        return $this->respond([
            'status' => 'success',
            'message' => 'Pembayaran Paket Data berhasil',
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
