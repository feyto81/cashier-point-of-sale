<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
            'g-recaptcha-response' => 'required|captcha',

        ]);
        if (Auth::attempt($request->only('email', 'password'))) {
            $username = auth()->user()->username;
            $level = Auth::user()->Level->name;
            alert()->success('Welcome To Kasir Aplication', 'Success');
            return redirect('admin/home');
        }
        return redirect()->back()->with(['error' => 'Invalid email or password']);
    }

    public function logout()
    {
        Auth::logout();
        alert()->success('Anda Berhasil Logout', 'Berhasil');
        return redirect('admin/login')->with(['success' => 'You have successfully logged out']);
    }
}
