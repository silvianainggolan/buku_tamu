<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use Illuminate\View\View;
use Illuminate\Support\Facades\Redirect;

class PegawaiController extends Controller
{
    /**
     * Menampilkan daftar pegawai dengan pencarian opsional.
     */
    public function index(Request $request): View
    {
        // Ambil parameter pencarian dari query string
        $search = $request->input('search');
        
        // Query untuk mendapatkan data pegawai dengan kondisi pencarian
        $query = Pegawai::query();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nip', 'like', "%{$search}%")
                  ->orWhere('nomor_handphone', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('jabatan', 'like', "%{$search}%");
            });
        }

        $pegawai = $query->latest()->paginate(10);

        return view('pegawai', compact('pegawai'));
    }

    /**
     * Menampilkan formulir untuk menambahkan pegawai baru.
     */
    public function tambah(): View
    {
        return view('tambah_pegawai');
    }

    /**
     * Menyimpan pegawai baru ke database.
     */
    public function simpan(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required',
            'nip' => 'required|min:5',
            'nomor_handphone' => 'required',
            'email' => 'required|email',
            'jabatan' => 'required'
        ]);

        // Simpan data pegawai
        $pegawai = Pegawai::create($request->only([
            'nama',
            'nip',
            'nomor_handphone',
            'email',
            'jabatan'
        ]));

        return redirect()->route('pegawai')->with('success', 'Berhasil menambahkan data pegawai.');
    }

    /**
     * Menampilkan formulir untuk mengedit pegawai yang ada.
     */
    public function edit(string $id): View
    {
        $pegawai = Pegawai::findOrFail($id);
        return view('edit_pegawai', compact('pegawai'));
    }

    /**
     * Memperbarui data pegawai di database.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required',
            'nip' => 'required|min:5',
            'nomor_handphone' => 'required',
            'email' => 'required|email',
            'jabatan' => 'required'
        ]);

        // Temukan pegawai dan perbarui data
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->update($request->only([
            'nama',
            'nip',
            'nomor_handphone',
            'email',
            'jabatan'
        ]));

        return redirect()->route('pegawai')->with('success', 'Data Berhasil Diubah!');
    }

    /**
     * Menghapus pegawai dari database.
     */
    public function hapus($id)
    {
        // Find the employee by ID or fail
        $pegawai = Pegawai::findOrFail($id);

        // Delete the employee
        $pegawai->delete();

        return redirect()->route('pegawai')->with('success', 'Data pegawai berhasil dihapus.');
    }
}
