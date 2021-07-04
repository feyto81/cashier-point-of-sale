<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Level;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;


class UsersController extends Controller
{
    public function index()
    {
        $user = User::all();
        $level = Level::all();
        return view('user.index', compact('level', 'user'));
    }

    public function create(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib diisi !!!',
            'unique' => 'attribut sama dengan database !!!',
            'numeric' => 'attribut harus diisi dengan angka !!!',
            'min' => ':attribute harus diisi minimal :min karakter!!!',
            'max' => ':attribute harus diisi maksimal :max karakter!!!',
        ];
        $this->validate($request, [
            'username' => 'required|min:2',
            'name' => 'required|min:2',
            'email' => 'required',
            'address' => 'required|min:3',
            'level_id' => 'required',
            'password' => 'required|min:6',
            'passwordconf' => 'required|same:password'
        ], $messages);
        $user_id = Auth::user()->id;
        $user = new User();
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->level_id = $request->level_id;
        $user->password = Hash::make($request->password);
        $result = $user->save();
        // \LogActivity::addToLog([
        //     'data' => 'Menambahkan User ' . $request->name,
        //     'user' => $user_id,
        // ]);
        if ($result) {
            alert()->success('User Successfully Saved', 'Success');
            return back();
        } else {
            alert()->error('User Gagal Ditambahkan', 'Berhasil');
            return back();
        }
    }

    public function edit($id)
    {
        $level = Level::all();
        $user = User::find($id);
        return view('user.edit', compact('user', 'level'));
    }
    public function update(Request $request, $id)
    {
        $messages = [
            'required' => ':attribute wajib diisi !!!',
            'unique' => 'attribut sama dengan database !!!',
            'numeric' => 'attribut harus diisi dengan angka !!!',
            'min' => ':attribute harus diisi minimal :min karakter!!!',
            'max' => ':attribute harus diisi maksimal :max karakter!!!',
        ];
        $this->validate($request, [
            'username' => 'required|min:2',
            'name' => 'required|min:2',
            'email' => 'required',
            'address' => 'required|min:3',
            'level_id' => 'required',
            'password' => '',
            'confPassword' => 'same:password'
        ], $messages);
        $user_id = Auth()->user()->id;
        $user = User::find($id);
        $user->name = $request->get('name');
        $user->username = $request->get('username');
        $user->email = $request->get('email');
        $user->address = $request->get('address');
        $user->username = $request->get('username');
        $user->level_id = $request->get('level_id');
        if ($request->get('password') != '') {
            $user->password = Hash::make($request->get('password'));
        }

        $aks = $user->save();
        // \LogActivity::addToLog([
        //     'data' => 'Mengupdate User ' . $user->name,
        //     'user' => $user_id,
        // ]);
        if ($aks) {
            alert()->success('User Successfully Updated', 'Success');
            return redirect('admin/users');
        } else {
            return back();
        }
    }

    public function destroy($id)
    {
        $user_id = Auth::user()->id;
        $user = User::find($id);
        // \LogActivity::addToLog([
        //     'data' => 'Menghapus User ' . $user->name,
        //     'user' => $user_id,
        // ]);
        $user->delete();
        alert()->success('User Successfully Deleted', 'Berhasil');
        return back();
    }
}
