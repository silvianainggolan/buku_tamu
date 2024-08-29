<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use Illuminate\View\View;

class PegawaiController extends Controller
{
    /**
     * Menampilkan daftar pegawai dengan pencarian opsional.
     */
    public function index(Request $request): View
    {
        $search = $request->input('search');
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

        $pegawai = $query->latest()->paginate(3);

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
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:255|unique:pegawai,nip',
            'nomor_handphone' => 'required|string|max:15|unique:pegawai,nomor_handphone',
            'email' => 'required|string|email|max:255|unique:pegawai,email',
            'jabatan' => 'required|string|max:255',
        ], [
            'nip.unique' => 'NIP sudah terdaftar.',
            'nomor_handphone.unique' => 'Nomor handphone sudah digunakan.',
            'email.unique' => 'Email sudah digunakan.',
        ]);

        try {
            Pegawai::create($request->all());
            return redirect()->route('pegawai')->with('success', 'Berhasil menambahkan data pegawai.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan data pegawai.');
        }
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
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:255|unique:pegawai,nip,' . $id,
            'nomor_handphone' => 'required|string|max:15|unique:pegawai,nomor_handphone,' . $id,
            'email' => 'required|string|email|max:255|unique:pegawai,email,' . $id,
            'jabatan' => 'required|string|max:255',
        ], [
            'nip.unique' => 'NIP sudah terdaftar.',
            'nomor_handphone.unique' => 'Nomor handphone sudah digunakan.',
            'email.unique' => 'Email sudah digunakan.',
        ]);

        try {
            $pegawai = Pegawai::findOrFail($id);
            $pegawai->update($request->only([
                'nama',
                'nip',
                'nomor_handphone',
                'email',
                'jabatan'
            ]));

            return redirect()->route('pegawai')->with('success', 'Data Berhasil Diubah!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data pegawai.');
        }
    }

    /**
     * Menghapus pegawai dari database.
     */
    public function hapus($id)
    {
        try {
            $pegawai = Pegawai::findOrFail($id);
            $pegawai->delete();

            return redirect()->route('pegawai')->with('success', 'Data pegawai berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data pegawai.');
        }
    }
}
