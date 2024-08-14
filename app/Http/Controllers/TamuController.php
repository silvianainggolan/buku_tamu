<?php

namespace App\Http\Controllers;

use App\Models\Tamu;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class TamuController extends Controller
{
    public function index() 
    {
     $tamu = Tamu::with('pegawai')->latest()->paginate(10);
     return view('tamu',compact('tamu'));
    }

    public function tambah()
    {
        $pegawai = Pegawai::get();
        return view('tambah_tamu', ['pegawai' => $pegawai]);
    }

    public function simpan(Request $request)
    {
        $data = $request->all();
        
        $tamu = Tamu::create([
            "nama" => $data['nama'],
            "nomor_handphone" => $data['nomor_handphone'],
            "email" => $data['email'],
            "keperluan" => $data['keperluan'],
            "nip" => $data['nip'],
        ]);

        if($tamu){
            return redirect('/tamu')->with(['success'=>'Berhasil menambahkan data tamu.']);
        }else{
            return "GAGAL";
        }
    }
}


