<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function login()
    {
        return view('login.login');
    }

    public function postlogin(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {

            return redirect('admin/home');
        }
        alert()->error('Email dan Password Salah', 'Gagal');
        return redirect('admin/login');
    }
}
