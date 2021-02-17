<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SupplierExcel;
use App\Imports\SupplierImport;
use PDF;

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


    public function edit($supplier_id)
    {
        $data['supplier'] = Supplier::findOrFail($supplier_id);
        return view('supplier.edit', $data);
    }


    public function update(Request $request, $supplier_id)
    {
        $this->validate($request, [
            'name' => 'required|min:2',
            'phone' => 'required|min:2|numeric',
            'address' => 'required',
            'description' => 'required',
        ]);
        $supplier = Supplier::find($supplier_id);
        $supplier->name = $request->name;
        $supplier->phone = $request->phone;
        $supplier->address = $request->address;
        $supplier->description = $request->description;
        $supplier->update();
        alert()->success('Supplier has been saved', 'Success');
        return redirect('admin/supplier');
    }


    public function destroy($supplier_id)
    {
        $supplier = Supplier::find($supplier_id);
        $supplier->delete();
        alert()->success('Category has been deleted.', 'Success');
        return back();
    }

    public function export_excel()
    {
        return Excel::download(new SupplierExcel, 'Supplier.xlsx');
    }

    public function import_excel(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');
        $nama_file = rand() . $file->getClientOriginalName();
        $file->move('file_supplier', $nama_file);
        Excel::import(new SupplierImport, public_path('/file_supplier/' . $nama_file));
        alert()->success('Import Success', 'Success');
        return redirect()->back();
    }

    public function export_pdf()
    {
        $data['supplier'] = Supplier::all();
        $pdf = PDF::loadView('export.supplier_pdf', $data);
        return $pdf->stream('Supplier.pdf');
    }
}
