<?php

namespace App\Http\Controllers\Admin;

use PDF;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Exports\CustomerExcel;
use App\Imports\CustomerImport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{

    public function index()
    {
        $data['customer'] = Customer::all();
        return view('customer.index', $data);
    }


    public function create()
    {
        return view('customer.add');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:2|unique:customers',
            'phone' => 'required|min:2|numeric',
            'address' => 'required',
            'gender' => 'required',
            'email' => 'required|unique:customers'
        ]);
        $user_id = Auth::user()->id;
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->gender = $request->gender;
        $customer->email = $request->email;
        \LogActivity::addToLog([
            'data' => 'Menambahkan Customer ' . $request->name,
            'user' => $user_id,
        ]);
        $result = $customer->save();
        if ($result) {
            alert()->success('Customer has been saved', 'Success');
            return redirect('admin/customer');
        } else {
            alert()->error('Supplier Failed Added', 'Error');
            return back();
        }
    }





    public function destroy($customer_id)
    {
        $user_id = Auth::user()->id;
        $customer = Customer::find($customer_id);
        \LogActivity::addToLog([
            'data' => 'Menghapus Customer ' . $customer->name,
            'user' => $user_id,
        ]);
        $customer->delete();
        alert()->success('Customer has been deleted.', 'Success');
        return back();
    }

    public function edit($customer_id)
    {
        $data['customer'] = Customer::findOrFail($customer_id);
        return view('customer.edit', $data);
    }

    public function update(Request $request, $customer_id)
    {
        $this->validate($request, [
            'name' => 'required|min:2',
            'phone' => 'required|min:2|numeric',
            'address' => 'required',
            'gender' => 'required',
            'email' => 'required'
        ]);
        $user_id = Auth::user()->id;
        $customer = Customer::find($customer_id);
        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->email = $request->email;
        $customer->gender = $request->gender;
        \LogActivity::addToLog([
            'data' => 'Mengupdate Customer ' . $request->name,
            'user' => $user_id,
        ]);
        $customer->update();
        alert()->success('Supplier has been updated', 'Success');
        return redirect('admin/customer');
    }

    public function export_excel()
    {
        return Excel::download(new CustomerExcel, 'Customer.xlsx');
    }

    public function import_excel(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');
        $nama_file = rand() . $file->getClientOriginalName();
        $file->move('file_customer', $nama_file);
        Excel::import(new CustomerImport, public_path('/file_customer/' . $nama_file));
        alert()->success('Import Success', 'Success');
        return redirect()->back();
    }

    public function export_pdf()
    {
        $data['customer'] = Customer::all();
        $pdf = PDF::loadView('export.customer_pdf', $data);
        return $pdf->stream('Customer.pdf');
    }
}
