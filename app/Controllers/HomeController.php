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
}
