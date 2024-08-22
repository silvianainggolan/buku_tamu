<?php

namespace App\Http\Controllers;

use App\Models\Tamu;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TamuUserController extends Controller
{
    public function formTamu()
    {
        $pegawai = Pegawai::get();
        return view('user', ['pegawai' => $pegawai]);
    }

    public function store(Request $request)
    {
        // Validasi reCAPTCHA
        $recaptchaResponse = $request->input('g-recaptcha-response');
        $secretKey = '6LcMgCwqAAAAAPPL07LkEKPxS_dDyLXd_Mie3T9t'; // Ganti dengan secret key Anda

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => $secretKey,
            'response' => $recaptchaResponse,
            'remoteip' => $request->ip(),
        ]);

        $result = json_decode($response->body());

        if (!$result->success) {
            return back()->with('error', 'Tolong selesaikan reCAPTCHA')->withInput();
        }

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
            return redirect()->route('form.tamu')->with('success', 'Data berhasil disimpan, silahkan tunggu Resepsionis mengkonfirmasi!');
        } else {
            return redirect()->route('form.tamu')->with('error', 'Gagal menambahkan data tamu.');
        }      
    }
}
