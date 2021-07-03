<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StockOut;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class StockOutController extends Controller
{
    public function index()
    {
        $data['stock'] = StockOut::all();
        return view('transaction.stock_out.index', $data);
    }

    public function create()
    {
        $data['supplier'] = Supplier::all();
        $data['item'] = DB::table('items')
            ->join('units', 'items.unit_id', '=', 'units.unit_id')
            ->select('items.*', 'units.*', 'units.name as unit_name')
            ->get();
        return view('transaction.stock_out.add', $data);
    }

    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $cek_stock = $request->stock;
        $qty = $request->qty;

        if ($cek_stock > $qty) {
            $data = new StockOut;
            $data->item_id = $request->item_id;
            $data->type = 'out';
            $data->detail = $request->detail;
            $data->supplier_id = $request->supplier_id;
            $data->qty = $request->qty;
            $data->date = $request->date;
            $data->user_id = $user_id;
            $result = $data->save();
            if ($result) {
                alert()->success('Stock Out Successfully Add', 'Success');
                return redirect('admin/stock-out');
            } else {
                alert()->error('Stock Out Gagal Ditambahkan', 'Berhasil');
                return back();
            }
        }
        // \LogActivity::addToLog([
        //     'data' => 'Menambahkan Stock Out ' . $request->item_id,
        //     'user' => $user_id,
        // ]);
        alert()->error('Stock Out Melebihi Stock Awal', 'Error');
        return back();
    }

    public function delete_stock_out($stockout_id)
    {
        $stock = StockOut::find($stockout_id);
        $user_id = Auth::user()->id;
        // \LogActivity::addToLog([
        //     'data' => 'Menghapus Stock Out ' . $stock->item_id,
        //     'user' => $user_id,
        // ]);
        $stock->delete();
        alert()->success('Stock Out Successfully Deleted', 'Success');
        return back();
    }
}
