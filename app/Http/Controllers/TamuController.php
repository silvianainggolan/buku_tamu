<?php

namespace App\Http\Controllers;

use App\Models\Tamu;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;

class TamuController extends Controller
{
    public function index(Request $request)
    {
        // Ambil parameter pencarian dari query string
        $search = $request->input('search');
        
        // Query untuk mendapatkan data tamu dengan kondisi pencarian
        $query = Tamu::query();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nomor_handphone', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('keperluan', 'like', "%{$search}%")
                  ->orWhere('nip', 'like', "%{$search}%");
            });
        }

        $tamu = $query->latest()->paginate(10);

        return view('tamu', compact('tamu'));
    }

    public function tambah()
    {
        $pegawai = Pegawai::all(); // Dapatkan semua pegawai
        return view('tambah_tamu', compact('pegawai'));
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nomor_handphone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'keperluan' => 'required|string',
            'nip' => 'required|exists:pegawai,nip',
        ]);

        Tamu::create($request->all());

        return redirect()->route('tamu')->with('success', 'Berhasil menambahkan data tamu.');
    }

    public function edit($id)
    {
        $tamu = Tamu::findOrFail($id);
        $pegawai = Pegawai::all(); // Dapatkan semua pegawai
        return view('edit_tamu', compact('tamu', 'pegawai'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nomor_handphone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'keperluan' => 'required|string',
            'nip' => 'required|exists:pegawai,nip',
        ]);

        $tamu = Tamu::findOrFail($id);
        $tamu->update($request->all());

        return redirect()->route('tamu')->with('success', 'Berhasil memperbarui data tamu.');
    }

    public function konfirmasi(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|boolean',
            'tanggal_konfirmasi' => 'required|date',
            'waktu_konfirmasi' => 'required|date_format:H:i',
            'pesan' => 'nullable|string',
        ]);
    
        $tamu = Tamu::findOrFail($id);
    
        // Cek apakah pegawai sudah memiliki jadwal pada waktu yang sama
        $existingSchedule = Tamu::where('nip', $tamu->nip)
            ->where('tanggal_konfirmasi', $request->tanggal_konfirmasi)
            ->where('waktu_konfirmasi', $request->waktu_konfirmasi)
            ->where('status', 1) // Hanya cek untuk jadwal yang sudah dikonfirmasi
            ->first();
    
        if ($existingSchedule) {
            return redirect()->route('tamu')->with('error', 'Pegawai sudah memiliki jadwal dengan tamu lain pada waktu tersebut.');
        }
    
        $tamu->status = $request->status;
        $tamu->tanggal_konfirmasi = $request->tanggal_konfirmasi;
        $tamu->waktu_konfirmasi = $request->waktu_konfirmasi;
        $tamu->pesan = $request->pesan;
        $tamu->save();
    
        $temp = $request->status == 1 ? "Reservasi anda dikonfirmasi!" : "Reservasi anda tidak dikonfirmasi!";
        $data = [
            'name' => $temp,
            'body' => $request->pesan
        ];
    
        Mail::to($tamu->email)->send(new SendEmail($data));
    
        return redirect()->route('tamu')->with('success', 'Berhasil mengkonfirmasi data tamu.');
    }
    
    public function formKonfirmasi($id)
    {
        $tamu = Tamu::findOrFail($id);
        return view('formulir_konfirmasi', ['tamu' => $tamu]);
    }

    public function hapus($id)
    {
        $tamu = Tamu::findOrFail($id);
        $tamu->delete();

        return redirect()->route('tamu')->with('success', 'Data tamu berhasil dihapus.');
    }
}
