<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use Illuminate\View\View;

class PegawaiController extends Controller
{
    // This method displays a list of employees, with optional search functionality.
    public function index(Request $request): View
    {
        // Get the search query from the request
        $search = $request->input('search');

        // Build the query
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

        // Paginate the results, with the latest entries first
        $pegawai = $query->latest()->paginate(10);

        return view('pegawai', compact('pegawai'));
    }

    // Show the form to add a new employee
    public function tambah(): View
    {
        return view('tambah_pegawai');
    }

    // Save the new employee data to the database
    public function simpan(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'nip' => 'required|min:5',
            'nomor_handphone' => 'required',
            'email' => 'required|email',
            'jabatan' => 'required',
        ]);

        // Create a new Pegawai record
        $pegawai = Pegawai::create($data);

        // Check if the creation was successful
        if ($pegawai) {
            return redirect()->route('pegawai')->with(['success' => 'Berhasil menambahkan data pegawai.']);
        } else {
            return back()->withErrors(['msg' => 'Gagal menambahkan data pegawai.']);
        }
    }

    // Show the form to edit an existing employee
    public function edit(string $id): View
    {
        // Find the employee by ID or fail
        $pegawai = Pegawai::findOrFail($id);
        return view('edit_pegawai', compact('pegawai'));
    }

    // Update the employee data in the database
    public function update(Request $request, string $id)
    {
        // Validate the form inputs
        $request->validate([
            'nama' => 'required',
            'nip' => 'required|min:5',
            'nomor_handphone' => 'required',
            'email' => 'required|email',
            'jabatan' => 'required',
        ]);

        // Find the employee record by ID
        $pegawai = Pegawai::findOrFail($id);

        // Update the employee's details
        $pegawai->update($request->only(['nama', 'nip', 'nomor_handphone', 'email', 'jabatan']));

        return redirect()->route('pegawai')->with(['success' => 'Data Berhasil Diubah!']);
    }

    // Delete an employee record from the database
    public function hapus(string $id)
    {
        // Find the employee by ID or fail
        $pegawai = Pegawai::findOrFail($id);

        // Delete the employee
        $pegawai->delete();

        return redirect()->route('pegawai')->with('success', 'Data pegawai berhasil dihapus.');
    }
}
