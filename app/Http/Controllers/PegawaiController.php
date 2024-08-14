<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PegawaiController extends Controller
{
    public function index(): View
{
    $pegawai = Pegawai::oldest()->paginate(10);

    return view('pegawai', compact('pegawai'));
}
    public function tambah(): View
    {
        return view('tambah_pegawai');
    }

    public function simpan(Request $request)
    {
        $data = $request->all();

        $pegawai = Pegawai::create([
            "nama" => $data['nama'],
            "nip" => $data['nip'],
            "nomor_handphone" => $data['nomor_handphone'],
            "email" => $data['email'],
            "jabatan" => $data['jabatan'],
        ]);

        if ($pegawai) {
            return redirect()->route('pegawai')->with(['success' => 'Berhasil menambahkan data pegawai.']);
        } else {
            return "GAGAL";
        }
    }
    public function edit(string $id): View
    {
        $pegawai = pegawai::findOrFail($id);
        return view('edit_pegawai', compact('pegawai'));
    }
    public function update(Request $request, $id)
    {
        //validate form
        $request->validate([
            'nama'         => 'required',
            'nip'         => 'required|min:5',
            'nomor_handphone'   => 'required',
            'email'         => 'required',
            'jabatan'         => 'required'
        ]);


        $pegawai = pegawai::findOrFail($id);


        $pegawai->update([
            'nama'         => $request->nama,
            'nip'         => $request->nip,
            'nomor_handphone'   => $request->nomor_handphone,
            'email'         => $request->email,
            'jabatan'         => $request->jabatan
        ]);

        return redirect()->route('pegawai')->with(['success' => 'Data Berhasil Diubah!']);
    }
    public function hapus($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->delete();

        return redirect()->route('pegawai')->with('success', 'Data pegawai berhasil dihapus.');
    }

}
