<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tamu;
use App\Models\Pegawai; // Import model Pegawai

class EventController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('pegawai_id'); // Ubah menjadi 'pegawai_id' sesuai parameter pencarian

        $query = Tamu::with('pegawai');

        if ($search) {
            $query->whereHas('pegawai', function($q) use ($search) {
                $q->where('id', $search); // Filter berdasarkan ID pegawai
            });
        }

        $tamu = $query->get();

        $events = $tamu->map(function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->nama . ' (' . ($item->status == 0 ? 'Belum Dikonfirmasi' : 'Dikonfirmasi') . ')',
                'start' => $item->tanggal_konfirmasi . 'T' . $item->waktu_konfirmasi,
                'end' => $item->tanggal_konfirmasi . 'T' . $item->waktu_konfirmasi,
                'description' => $item->pesan,
                'keperluan' => $item->keperluan,
                'pegawai' => $item->pegawai ? $item->pegawai->nama : 'Tidak Diketahui',
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
            'pegawai_id' => 'required|exists:pegawai,id',
            'keperluan' => 'nullable|string',
            'status' => 'required|integer|in:0,1',
        ]);

        $event = Tamu::create([
            'nama' => $request->title,
            'status' => $request->status,
            'tanggal_konfirmasi' => $request->start,
            'waktu_konfirmasi' => $request->end,
            'pesan' => $request->description,
            'pegawai_id' => $request->pegawai_id,
            'keperluan' => $request->keperluan,
        ]);

        return response()->json($event);
    }

    public function update(Request $request, $id)
    {
        $event = Tamu::findOrFail($id);

        $request->validate([
            'title' => 'required|string',
            'start' => 'required|date_format:Y-m-dTH:i:s',
            'end' => 'required|date_format:Y-m-dTH:i:s',
            'description' => 'nullable|string',
            'pegawai_id' => 'required|exists:pegawai,id',
            'keperluan' => 'nullable|string',
            'status' => 'required|integer|in:0,1',
        ]);

        $event->update([
            'nama' => $request->title,
            'status' => $request->status,
            'tanggal_konfirmasi' => $request->start,
            'waktu_konfirmasi' => $request->end,
            'pesan' => $request->description,
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

    public function getPegawai()
    {
        $pegawai = Pegawai::all(); // Ambil semua pegawai
        return response()->json($pegawai); // Kembalikan dalam format JSON
    }
}
