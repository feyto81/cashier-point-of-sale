<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Models\Unit;
use Storage;
use DB;
use PDF;


class ItemController extends Controller
{
    public function index()
    {
        $data['item'] = Item::all();
        return view('product.item.index', $data);
    }

    public function create()
    {
        $category = Category::all();
        $unit = Unit::all();
        return view('product.item.add', compact('category', 'unit'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'barcode' => 'required|min:2|unique:items',
            'name' => 'required|min:2',
            'category_id' => 'required',
            'unit_id' => 'required',
            'price' => 'required',
            'image' => 'required',
        ]);
        if (empty($request->file('image'))) {
            Item::create([
                'barcode' => $request->barcode,
                'name' => $request->name,
                'category_id' => $request->category_id,
                'unit_id' => $request->unit_id,
                'price' => $request->price,

            ]);
        } else {
            Item::create([
                'barcode' => $request->barcode,
                'name' => $request->name,
                'category_id' => $request->category_id,
                'unit_id' => $request->unit_id,
                'price' => $request->price,
                'image' => $request->file('image')->store('images', 'public'),
            ]);
        }
        alert()->success('Item has been saved', 'Success');
        return redirect('/admin/item');
    }

    public function destroy(Request $request, $item_id)
    {
        $item = Item::find($item_id);
        Storage::delete($item->image);
        $item->delete();
        alert()->success('Item has been deleted', 'Success');
        return back();
    }

    public function edit($item_id)
    {
        $data['category'] = Category::all();
        $data['unit'] = Unit::all();
        $data['item'] = Item::findOrFail($item_id);
        return view('product.item.edit', $data);
    }

    public function update(Request $request, $item_id)
    {

        $this->validate($request, [
            'barcode' => 'required|min:2',
            'name' => 'required|min:2',
            'category_id' => 'required',
            'unit_id' => 'required',
            'price' => 'required',
        ]);
        if (empty($request->file('image'))) {
            $item = Item::find($item_id);
            $item->update([
                'barcode' => $request->barcode,
                'name' => $request->name,
                'category_id' => $request->category_id,
                'unit_id' => $request->unit_id,
                'price' => $request->price,
            ]);
            alert()->error('Item has been updated', 'Success');
        } else {
            $item = Item::find($item_id);
            Storage::delete($item->image);
            $item->update([
                'barcode' => $request->barcode,
                'name' => $request->name,
                'category_id' => $request->category_id,
                'unit_id' => $request->unit_id,
                'price' => $request->price,
                'image' => $request->file('image')->store('images', 'public'),
            ]);
        }

        alert()->success('Item has been updated', 'Success');
        return redirect('/admin/item');
    }

    public function barcodeqrcode($item_id)
    {
        $row = Item::find($item_id);
        return view('product.item.bq', compact('row'));
    }

    public function print_barcode($item_id)
    {
        $row = Item::find($item_id);
        $pdf = PDF::loadView('product.item.print_barcode', ['row' => $row]);
        return $pdf->stream('Barcode.pdf');
    }

    public function print_qrcode($item_id)
    {
        $data = Item::find($item_id);
        $pdf = PDF::loadView('product.item.print_qrcode', ['data' => $data]);
        return $pdf->stream('QR-Code.pdf');
    }

    public function print_all_barcode()
    {
        $row = Item::all();
        $pdf = PDF::loadView('product.item.all_barcode', ['row' => $row]);
        return $pdf->stream('All Barcode.pdf');
    }

    public function print_all_qrcode()
    {
        $row = Item::all();
        $pdf = PDF::loadView('product.item.all_qrcode', ['row' => $row]);
        return $pdf->stream('All QR-Code.pdf');
    }
}
