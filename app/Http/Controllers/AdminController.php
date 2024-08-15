<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function index()
    {
        $admins = User::all();
        $logged_user = \Auth::user();
        return view('admins.index', compact('admins', 'logged_user'));
    }

    public function create(): View
    {
        return view('admins.create');
    }

    public function simpan(Request $request)
    {
        $data = $request->all();

        $admins = User::create([
            "name" => $data['name'],
            "email" => $data['email'],
            "password" => $data['password']
        ]);

        if ($admins) {
            return redirect()->route('admins')->with(['success' => 'Berhasil menambahkan data admin.']);
        } else {
            return "GAGAL";
        }
    }
    public function edit(string $id): View
    {
        $admins = User::findOrFail($id);
        return view('admins.edit', compact('admins'));
    }
    public function update(Request $request, $id)
    {
        //validate form
        $request->validate([
            'name'         => 'required',
            'email'         => 'required'
        ]);


        $admins = User::findOrFail($id);

        if(isset($request->password)){
            $admins->update([
                'name'         => $request->name,
                'email'         => $request->email,
                'password'   => $request->password,
            ]);
        }else{
            $admins->update([
                'name'         => $request->name,
                'email'         => $request->email
            ]);
        }

        return redirect()->route('admins')->with(['success' => 'Data Berhasil Diubah!']);
    }
    public function hapus($id)
    {
        $admins = User::findOrFail($id);
        $admins->delete();

        return redirect()->route('admins')->with('success', 'Data admin berhasil dihapus.');
    }

}
