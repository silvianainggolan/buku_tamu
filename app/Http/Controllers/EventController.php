<?php
// app/Http/Controllers/EventController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tamu;

class EventController extends Controller
{
    public function index()
    {
        $tamu = Tamu::with('pegawai')->get();

        $events = $tamu->map(function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->nama . ' (' . ($item->status == 0 ? 'Belum Dikonfirmasi' : 'Dikonfirmasi') . ')',
                'start' => $item->tanggal_konfirmasi . 'T' . $item->waktu_konfirmasi,
                'end' => $item->tanggal_konfirmasi . 'T' . $item->waktu_konfirmasi, 
                'description' => $item->pesan, // Menambahkan pesan
                'keperluan' => $item->keperluan, // Menambahkan keperluan
                'pegawai' => $item->pegawai ? $item->pegawai->nama : 'Tidak Diketahui', // Menambahkan nama pegawai
                'className' => $item->status == 0 ? 'status-belum' : 'status-dikonfirmasi',
            ];
        });

        return response()->json($events);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'start' => 'required|date_format:Y-m-dTH:i:s',
            'end' => 'required|date_format:Y-m-dTH:i:s',
            'description' => 'nullable|string',
            'pegawai_id' => $request->pegawai_id, // Menyimpan pegawai_id
            'keperluan' => $request->keperluan, // Menyimpan keperluan
        ]);
    
    
        $event = Tamu::create([
            'nama' => $request->title,
            'status' => $request->status,
            'tanggal_konfirmasi' => $request->start,
            'waktu_konfirmasi' => $request->end,
            'pesan' => $request->description, // Menyimpan pesan
            'pegawai_id' => $request->pegawai_id, // Menyimpan pegawai_id
            'keperluan' => $request->keperluan, // Menyimpan keperluan
        ]);

        return response()->json($event);
    }
    public function update(Request $request, $id)
{
    $event = Tamu::findOrFail($id);

    $event->update([
        'nama' => $request->title,
        'status' => $request->status,
        'tanggal_konfirmasi' => $request->start,
        'waktu_konfirmasi' => $request->end,
        'pesan' => $request->description, // Menyimpan pesan
        'pegawai_id' => $request->pegawai_id,
            'keperluan' => $request->keperluan,
    ]);

    return response()->json($event);
}

public function destroy($id)
{
    $event = Tamu::findOrFail($id);
    $event->delete();

    return response()->json(['success' => true]);
}

   
}
