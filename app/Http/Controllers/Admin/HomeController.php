<?php

namespace App\Http\Controllers\Admin;

use App\Models\Item;
use App\Models\Sale;
use App\Models\Unit;
use App\Models\User;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function index()
    {
        $user = User::count();
        $customer = Customer::count();
        $supplier = Supplier::count();
        $category = Category::count();
        $unit = Unit::count();
        $item = Item::count();
        $sales = Sale::count();
        $pemasukan1 = DB::table('sales')->sum('final_price');
        $pemasukan2 = DB::table('pemasukan')->sum('pemasukan_count');
        $pemasukan = $pemasukan1;
        $pengeluaran = DB::table('pengeluaran')->sum('pengeluaran_count');
        $laba = $pemasukan - $pengeluaran;
        //bulan
        $data = DB::table("sales")->select(DB::raw('EXTRACT(MONTH FROM created) AS Bulan, SUM(final_price) as Pendapatan'))
            ->groupBy(DB::raw('EXTRACT(MONTH FROM created)'))
            ->get();
        //tahun
        $tahun = DB::table("sales")->select(DB::raw('EXTRACT(YEAR FROM created) AS Tahun, SUM(final_price) as Pendapatan1'))
            ->groupBy(DB::raw('EXTRACT(YEAR FROM created)'))
            ->get();

        return view('home', compact('user', 'customer', 'supplier', 'category', 'unit', 'item', 'sales', 'pemasukan', 'pengeluaran', 'laba', 'data', 'tahun'));
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

    public function logActivity()
    {
        $logs = DB::table('log_activity')
            ->leftJoin('users', 'log_activity.user_id', '=', 'users.id')
            ->select('log_activity.*', 'users.name')
            ->get();
        $user = User::all();
        $logs = \LogActivity::logActivityLists();
        return view('logactivity.index', compact('logs', 'user'));
    }
}
