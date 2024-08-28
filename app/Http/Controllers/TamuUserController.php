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
        'tanggal_berkunjung' => 'required|date',
        'jam_berkunjung' => 'required|date_format:H:i',
    ]);

    // Cek apakah nama dan email yang sama sudah ada pada hari yang sama
    $existingVisit = Tamu::where('nama', $validatedData['nama'])
        ->where('email', $validatedData['email'])
        ->whereDate('tanggal_berkunjung', $validatedData['tanggal_berkunjung'])
        ->exists();

    if ($existingVisit) {
        return back()->with('error', 'Anda sudah memiliki janji pada hari ini dengan email yang sama.')->withInput();
    }

    // Cek apakah waktu kunjungan berada pada jam istirahat (12:00 - 13:00)
    $visitTime = strtotime($validatedData['jam_berkunjung']);
    $startBreak = strtotime('12:00');
    $endBreak = strtotime('13:00');

    if ($visitTime >= $startBreak && $visitTime < $endBreak) {
        return back()->with('error', 'Anda tidak dapat berkunjung pada jam istirahat (12:00 - 13:00).')->withInput();
    }

    // Cek apakah ada tamu lain yang sudah memiliki jadwal dalam 31 menit sebelum atau setelah waktu kunjungan
    $existingOverlapVisit = Tamu::where('nip', $validatedData['nip'])
        ->where('status',1)
        ->whereDate('tanggal_berkunjung', $validatedData['tanggal_berkunjung'])
        ->where(function ($query) use ($validatedData) {
            $query->whereBetween('jam_berkunjung', [
                date('H:i', strtotime($validatedData['jam_berkunjung']) - 31 * 60),
                date('H:i', strtotime($validatedData['jam_berkunjung']) + 30 * 60)
            ]);
        })
        ->exists();

    if ($existingOverlapVisit) {
        return back()->with('error', 'Tamu lain sudah memiliki janji dalam waktu 31 menit sebelum atau setelah jam kunjungan ini.')->withInput();
    }

    // Simpan data ke database
    $tamu = new Tamu();
    $tamu->nama = $validatedData['nama'];
    $tamu->nomor_handphone = $validatedData['nomor_handphone'];
    $tamu->email = $validatedData['email'];
    $tamu->keperluan = $validatedData['keperluan'];
    $tamu->nip = $validatedData['nip'];
    $tamu->tanggal_berkunjung = $validatedData['tanggal_berkunjung'];
    $tamu->jam_berkunjung = $validatedData['jam_berkunjung'];
    $tamu->save();

    // Redirect dengan pesan sukses
    return redirect()->route('form.tamu')->with('success', 'Data berhasil disimpan, silahkan tunggu Resepsionis mengkonfirmasi!');
}
}
