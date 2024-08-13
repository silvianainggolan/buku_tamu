<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Redirect;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::get();

        return view('pegawai', ['pegawai' => $pegawai]);
    }

    public function tambah()
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

        if($pegawai){
            $data = Pegawai::get();

            return view('pegawai', ['pegawai' => $data]);
        }else{
            return "GAGAL";
        }
    }
}
