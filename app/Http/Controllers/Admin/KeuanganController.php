<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KeuanganController extends Controller
{
    public function index()
    {
        $pemasukan1 = DB::table('pemasukan')->sum('pemasukan_count');
        $pengeluaran = DB::table('pengeluaran')->sum('pengeluaran_count');
        $penjualan = DB::table('sales')->sum('final_price');

        return view('keuangan.akumulasi.index', compact('pemasukan1', 'pengeluaran', 'penjualan'));
    }
}
