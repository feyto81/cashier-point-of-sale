<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StockIn;

class StockInController extends Controller
{
    public function index()
    {
        $data['stock'] = StockIn::all();
        return view('transaction.stock_in.index', $data);
    }
    public function create()
    {
        $data['stock'] = StockIn::all();
        return view('transaction.stock_in.index', $data);
    }
}
