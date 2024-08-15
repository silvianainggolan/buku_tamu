<?php

namespace App\Http\Controllers;

use App\Models\Tamu;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class TamuUserController extends Controller
{
    public function formTamu()
    {
        $pegawai = Pegawai::get();
        return view('user', ['pegawai' => $pegawai]);
    }
    public function store(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nomor_handphone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'keperluan' => 'required|string',
            'nip' => 'required|string|max:20',
        ]);

        // Simpan data ke database
        $tamu = new Tamu();
        $tamu->nama = $validatedData['nama'];
        $tamu->nomor_handphone = $validatedData['nomor_handphone'];
        $tamu->email = $validatedData['email'];
        $tamu->keperluan = $validatedData['keperluan'];
        $tamu->nip = $validatedData['nip'];
        $tamu->save();

        // Redirect dengan pesan sukses
        if ($tamu) {
            return redirect()->route('tamu')->with('success', 'Berhasil menambahkan data tamu.');
        } else {
            return redirect()->route('tamu')->with('error', 'Gagal menambahkan data tamu.');
        }      
    }
}
