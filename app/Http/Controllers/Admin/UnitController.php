<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit;

class UnitController extends Controller
{
    public function index()
    {
        $data['unit'] = Unit::all();
        return view('product.unit.index', $data);
    }

    public function create()
    {
        return view('product.unit.add');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:2|unique:units',
        ]);
        $unit = new Unit;
        $unit->name = $request->name;
        $result = $unit->save();
        if ($result) {
            alert()->success('Unit has been saved', 'Success');
            return redirect('/admin/unit');
        } else {
            alert()->error('Unit Failed Added', 'Success');
            return back();
        }
    }

    public function destroy(Request $request, $unit_id)
    {
        $unit = Unit::find($unit_id);
        $unit->delete();
        alert()->success('Unit has been deleted', 'Success');
        return back();
    }

    public function edit($unit_id)
    {
        $data['unit'] = Unit::findOrFail($unit_id);
        return view('product.unit.edit', $data);
    }

    public function update(Request $request, $unit_id)
    {
        $this->validate($request, [
            'name' => 'required|min:2',
        ]);
        $unit = Unit::find($unit_id);
        $unit->name = $request->name;
        $unit->update();
        alert()->success('Unit has been updated', 'Success');
        return redirect('/admin/unit');
    }
}
