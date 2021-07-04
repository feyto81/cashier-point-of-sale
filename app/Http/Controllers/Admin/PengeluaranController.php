<?php

namespace App\Http\Controllers\Admin;

use App\Exports\PengeluaranExcel;
use App\Http\Controllers\Controller;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
use Maatwebsite\Excel\Facades\Excel;

class PengeluaranController extends Controller
{

    public function index()
    {
        $data['pengeluaran'] = Pengeluaran::all();
        return view('keuangan.pengeluaran.index', $data);
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
            'pengeluaran_count' => 'required|min:2',
            'keterangan' => 'required|min:2',
        ], $messages);
        $user_id = Auth::user()->id;
        $pengeluaran = new Pengeluaran();
        $pengeluaran->pengeluaran_count = $request->pengeluaran_count;
        $pengeluaran->keterangan = $request->keterangan;
        \LogActivity::addToLog([
            'data' => 'Menambahkan Pengeluaran ' . $request->pengeluaran_count,
            'user' => $user_id,
        ]);
        $result = $pengeluaran->save();
        if ($result) {
            alert()->success('Data Successfully Saved', 'Success');
            return back();
        } else {
            alert()->error('Pengeluaran Gagal Ditambahkan', 'Berhasil');
            return back();
        }
    }

    public function destroy($pengeluaran_id)
    {
        $pengeluaran = Pengeluaran::find($pengeluaran_id);
        $user_id = Auth::user()->id;
        \LogActivity::addToLog([
            'data' => 'Menghapus Pengeluaran ' . $pengeluaran->pengeluaran_count,
            'user' => $user_id,
        ]);
        $pengeluaran->delete();
        alert()->success('Data Successfully Deleted', 'Berhasil');
        return back();
    }

    public function edit_pengeluaran($pengeluaran_id)
    {
        $pengeluaran = Pengeluaran::find($pengeluaran_id);
        return view('keuangan.pengeluaran.edit', compact('pengeluaran'));
    }
    public function update_pengeluaran(Request $request, $pengeluaran_id)
    {
        $messages = [
            'required' => ':attribute wajib diisi !!!',
            'unique' => 'attribut sama dengan database !!!',
            'numeric' => 'attribut harus diisi dengan angka !!!',
            'min' => ':attribute harus diisi minimal :min karakter!!!',
            'max' => ':attribute harus diisi maksimal :max karakter!!!',
        ];
        $this->validate($request, [
            'pengeluaran_count' => 'required|numeric',
            'keterangan' => 'required|min:2',

        ], $messages);
        $user_id = Auth::user()->id;
        $pengeluaran = Pengeluaran::find($pengeluaran_id);
        $pengeluaran->pengeluaran_count = $request->get('pengeluaran_count');
        $pengeluaran->keterangan = $request->get('keterangan');
        \LogActivity::addToLog([
            'data' => 'Mengupdate Pengeluaran ' . $request->pengeluaran_count,
            'user' => $user_id,
        ]);
        $aks = $pengeluaran->save();
        if ($aks) {
            alert()->success('Pengeluaran Successfully Updated', 'Success');
            return redirect('admin/finance/pengeluaran');
        } else {
            return back();
        }
    }

    // public function export_excel()
    // {
    //     return Excel::download(new PengeluaranExcel, 'Pengeluaran.xlsx');
    // }

    public function export_excel()
    {
        return Excel::download(new PengeluaranExcel, 'Pengeluaran.xlsx');
    }

    public function export_pdf()
    {
        $pengeluaran = Pengeluaran::all();
        $pdf = PDF::loadView('export.pengeluaran_pdf', compact('pengeluaran'));
        return $pdf->stream('Pengeluaran.pdf');
    }
}
