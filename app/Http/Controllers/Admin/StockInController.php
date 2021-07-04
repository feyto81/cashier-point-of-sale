<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StockIn;
use App\Models\Supplier;
use Auth;
use DB;

class StockInController extends Controller
{
    public function index()
    {
        $data['stock'] = StockIn::all();
        return view('transaction.stock_in.index', $data);
    }
    public function create()
    {
        $data['user_id'] = Auth::user()->id;
        $data['supplier'] = Supplier::all();
        $data['stock'] = StockIn::all();
        $data['item'] = DB::table('items')
            ->join('units', 'items.unit_id', '=', 'units.unit_id')
            ->select('items.*', 'units.*', 'units.name as unit_name')
            ->get();
        return view('transaction.stock_in.add', $data);
    }

    public function store(Request $request)
    {
        $user_id = Auth::user()->id;

        for ($a = 0; $a < count($request->item_id); $a++) {

            DB::table('stockin')->insert([
                'item_id' =>  $request->item_id[$a],
                'type' => 'in',
                'detail' => $request->detail,
                'supplier_id' => $request->supplier_id,
                'qty' => $request->qty[$a],
                'date' => $request->date,
                'user_id' => $user_id
            ]);
            \LogActivity::addToLog([
                'data' => 'Menambahkan Stock In ',
                'user' => $user_id,
            ]);
            alert()->success('Stock In Successfully Added', 'Success');
            return redirect('admin/stock-in');
        }
    }
    public function delete_stock_in($stockin_id)
    {
        $stock = Stockin::find($stockin_id);
        $user_id = Auth::user()->id;
        \LogActivity::addToLog([
            'data' => 'Menghapus Stock In ' . $stock->item_id,
            'user' => $user_id,
        ]);
        $stock->delete();
        alert()->success('Stock Successfully Deleted', 'Success');
        return back();
    }
}
