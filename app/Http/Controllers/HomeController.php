<?php

namespace App\Http\Controllers;

use App\Models\ListKegiatan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'tugas' => 'required',
            'hari' => 'required',
            'tanggal' => 'required',
            'jam' => 'required',
            'status' => 'required',
            'jenis' => 'required',
        ]);
        $simpan = new ListKegiatan();
        $simpan->tugas = $request->tugas;
        $simpan->hari = $request->hari;
        $simpan->tanggal = $request->tanggal;
        $simpan->jam = $request->jam;
        $simpan->status = $request->status;
        $simpan->jenis = $request->jenis;
        $simpan->save();
        Alert::success('Berhasil', 'Ditambahkan');
        return redirect()->back();
    }

    public function edit(Request $request, $idtugas)
    {
        $request->validate([
            'tugas' => 'required',
            'hari' => 'required',
            'tanggal' => 'required',
            'jam' => 'required',
            'status' => 'required',
            'jenis' => 'required',
        ]);
        $edit = ListKegiatan::findOrFail($idtugas);
        $edit->tugas = $request->tugas;
        $edit->hari = $request->hari;
        $edit->tanggal = $request->tanggal;
        $edit->jam = $request->jam;
        $edit->status = $request->status;
        $edit->jenis = $request->jenis;
        $edit->save();
        Alert::success('Berhasil', 'Diedit');
        return redirect()->back();
    }

    public function hapus($id)
    {
        $hapus = ListKegiatan::findOrFail($id);
        $hapus->delete();
        Alert::success('Berhasil', 'Dihapus');
        return redirect()->back();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home')->with([
            'datas' => ListKegiatan::all()
        ]);
    }
}
