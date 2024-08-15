<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function index(): View
{
    $admins = Admin::all();
    return view('admins.index', compact('admins'));
}
    public function create(): View
    {
        return view('admins.create');
    }

    public function simpan(Request $request)
    {
        $data = $request->all();

        $admins = Admin::create([
            "nama" => $data['nama'],
            "email" => $data['email'],
            "password" => $data['password'],
            
        ]);

        if ($admins) {
            return redirect()->route('admins')->with(['success' => 'Berhasil menambahkan data admin.']);
        } else {
            return "GAGAL";
        }
    }
    public function edit(string $id): View
    {
        $admins = Admin::findOrFail($id);
        return view('admins.edit', compact('admins'));
    }
    public function update(Request $request, $id)
    {
        //validate form
        $request->validate([
            'nama'         => 'required',
            'nip'         => 'required|min:5',
            'nomor_handphone'   => 'required',
            'email'         => 'required',
            'jabatan'         => 'required'
        ]);


        $admins = Admin::findOrFail($id);


        $admins->update([
            'nama'         => $request->nama,
            'email'         => $request->email,
            'password'   => $request->passwor(d),
           
        ]);

        return redirect()->route('admins')->with(['success' => 'Data Berhasil Diubah!']);
    }
    public function hapus($id)
    {
        $admins = Admin::findOrFail($id);
        $admins->delete();

        return redirect()->route('admins')->with('success', 'Data admin berhasil dihapus.');
    }

}
