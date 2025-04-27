<?php

namespace App\Controllers;

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
}