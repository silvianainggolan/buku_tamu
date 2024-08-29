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
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nomor_handphone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'keperluan' => 'required|string',
            'nip' => 'required|exists:pegawai,nip',
            'tanggal_berkunjung' => 'required|date',
            'jam_berkunjung' => 'required|date_format:H:i',
        ]);
    
        // Cek apakah waktu kunjungan berada pada jam istirahat (12:00 - 13:00)
        $visitTime = strtotime($validatedData['jam_berkunjung']);
        $startBreak = strtotime('12:00');
        $endBreak = strtotime('13:00');

        if ($visitTime >= $startBreak && $visitTime < $endBreak) {
            return back()->with('error', 'Anda tidak dapat berkunjung pada jam istirahat (12:00 - 13:00).')->withInput();
        }
    
        // Cek apakah nama dan email yang sama sudah ada pada hari yang sama
        $existingVisit = Tamu::where('nama', $validatedData['nama'])
        ->where('email', $validatedData['email'])
        ->whereDate('tanggal_berkunjung', $validatedData['tanggal_berkunjung'])
        ->exists();

        if ($existingVisit) {
            return back()->with('error', 'Anda sudah memiliki janji pada hari ini dengan email yang sama.')->withInput();
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
            
            'tamu' => $tamu,
            'tanggal_berkunjung' => $request->tanggal_berkunjung, 
            'jam_berkunjung' => $request->jam_berkunjung 

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
