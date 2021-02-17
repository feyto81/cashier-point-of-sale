<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{

    public function index()
    {
        $this->data['supplier'] = Supplier::all();
        return view('supplier.index', $this->data);
    }


    public function create()
    {
        return view('supplier.add');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:2|unique:suppliers',
            'phone' => 'required|min:2|numeric',
            'address' => 'required',
            'description' => 'required',
        ]);
        $supplier = new Supplier;
        $supplier->name = $request->name;
        $supplier->phone = $request->phone;
        $supplier->address = $request->address;
        $supplier->description = $request->description;
        $result = $supplier->save();
        if ($result) {
            alert()->success('Supplier has been saved', 'Success');
            return redirect('admin/supplier');
        } else {
            alert()->error('Supplier Failed Added', 'Error');
            return back();
        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($supplier_id)
    {
        $supplier = Supplier::find($supplier_id);
        $supplier->delete();
        alert()->success('Category has been deleted.', 'Success');
        return back();
    }
}
