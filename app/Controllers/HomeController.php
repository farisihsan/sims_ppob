<?php

namespace App\Controllers;
use App\Models\Transaction;
class HomeController extends BaseController
{
    public function index()
    {
        $user = session()->get('user');
        return view('home', ['user' => $user]);
    }

    public function profile()
    {
        $user = session()->get('user');
        return view('profile/profile', ['user' => $user]);
    }

    public function topup()
    {
        $user = session()->get('user');
        return view('profile/topup', ['user' => $user]);
    }
    public function transaksi(){
        $user = session()->get('user');
        $bulan = $this->request->getGet('bulan');
        $tahun = $this->request->getGet('tahun') ?? date('Y');

        $transaction = new Transaction();
        $query = $transaction->where('user_id', $user['id']);
        if ($bulan) {
            $query = $query->where('MONTH(created_on)', $bulan);
        }
        if ($tahun) {
            $query = $query->where('YEAR(created_on)', $tahun);
        }
        $transaction = $query->orderBy('created_on', 'DESC')->findAll();

        return view('transaction/history', [
            'transaction' => $transaction,
            'user' => $user,
            'bulan' => $bulan,
            'tahun' => $tahun
        ]);
    }
    public function getMoreHistory()
    {
        $limit = $this->request->getGet('limit');
        $offset = $this->request->getGet('offset');
        $userId = session()->get('user')['id'];

        $model = new Transaction();
        $transactions = $model->where('user_id', $userId)
                              ->orderBy('created_on', 'DESC')
                              ->findAll($limit, $offset);

        return $this->response->setJSON($transactions);
    }
    
    public function pbb()
    {
        $user = session()->get('user');
        return view('transaction/pbb', ['user' => $user]);
    }
    public function listrik()
    {
        $user = session()->get('user');
        return view('transaction/listrik', ['user' => $user]);
    }
    public function pulsa()
    {
        $user = session()->get('user');
        return view('transaction/pulsa', ['user' => $user]);
    }
    public function pdam()
    {
        $user = session()->get('user');
        return view('transaction/pdam', ['user' => $user]);
    }
    public function pgn()
    {
        $user = session()->get('user');
        return view('transaction/pgn', ['user' => $user]);
    }
    public function tv_langganan()
    {
        $user = session()->get('user');
        return view('transaction/tv-langganan', ['user' => $user]);
    }
    public function musik()
    {
        $user = session()->get('user');
        return view('transaction/musik', ['user' => $user]);
    }
    public function voucher_game()
    {
        $user = session()->get('user');
        return view('transaction/voucher-game', ['user' => $user]);
    }
    public function voucher_makanan()
    {
        $user = session()->get('user');
        return view('transaction/voucher-makan', ['user' => $user]);
    }
    public function kurban()
    {
        $user = session()->get('user');
        return view('transaction/kurban', ['user' => $user]);
    }
    public function zakat()
    {
        $user = session()->get('user');
        return view('transaction/zakat', ['user' => $user]);
    }
    public function paket_data()
    {
        $user = session()->get('user');
        return view('transaction/paket-data', ['user' => $user]);
    }

    
}