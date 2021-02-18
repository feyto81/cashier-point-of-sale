<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $data['category'] = Category::all();
        return view('product.categories.index', $data);
    }

    public function create()
    {
        return view('product.categories.add');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:2|unique:categories',
        ]);
        $category = new Category;
        $category->name = $request->name;
        $result = $category->save();
        if ($result) {
            alert()->success('Category has been saved', 'Success');
            return redirect('/admin/category');
        } else {
            alert()->error('Category Failed Added', 'Success');
            return back();
        }
    }

    public function destroy(Request $request, $category_id)
    {
        $category = Category::find($category_id);
        $category->delete();
        alert()->success('Category has been deleted', 'Success');
        return back();
    }

    public function edit($category_id)
    {
        $data['category'] = Category::findOrFail($category_id);
        return view('product.categories.edit', $data);
    }

    public function update(Request $request, $category_id)
    {
        $this->validate($request, [
            'name' => 'required|min:2',
        ]);
        $category = Category::find($category_id);
        $category->name = $request->name;
        $category->update();
        alert()->success('Category has been updated', 'Success');
        return redirect('/admin/category');
    }
}
