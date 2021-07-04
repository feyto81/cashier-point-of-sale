<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
        $user_id = Auth::user()->id;
        $category = new Category;
        $category->name = $request->name;
        \LogActivity::addToLog([
            'data' => 'Menambahkan Category ' . $request->name,
            'user' => $user_id,
        ]);
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
        $user_id = Auth::user()->id;
        $category = Category::find($category_id);
        \LogActivity::addToLog([
            'data' => 'Delete Category ' . $category->name,
            'user' => $user_id,
        ]);
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
        $user_id = Auth::user()->id;
        $category = Category::find($category_id);
        $category->name = $request->name;
        \LogActivity::addToLog([
            'data' => 'Update Category ' . $request->name,
            'user' => $user_id,
        ]);
        $category->update();
        alert()->success('Category has been updated', 'Success');
        return redirect('/admin/category');
    }
}
