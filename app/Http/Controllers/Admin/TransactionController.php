<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Item;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $data['customer'] = Customer::all();
        $data['item'] = Item::all();
        return view('transaction.sales.index', $data);
    }
}
