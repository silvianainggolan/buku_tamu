<?php

namespace App\Http\Controllers;
use App\Models\Tamu;
use Illuminate\Http\Request;

class Tamu_UserController extends Controller
{
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

       
        
    }
}
