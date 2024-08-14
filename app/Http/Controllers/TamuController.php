<?php

namespace App\Http\Controllers;

use App\Models\Tamu;
use Illuminate\Http\Request;

class TamuController extends Controller
{
    public function index() 
    {
     $tamu = Tamu::latest()->paginate(10);
 
     return view('tamu',compact('tamu'));
    }

    public function tambah()
    {
        return view('tambah_tamu');
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


