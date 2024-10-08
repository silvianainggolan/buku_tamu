<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tamu extends Model
{
    use HasFactory;

    protected $table = 'tamus';
    protected $fillable = [
        'nama',
        'nomor_handphone',
        'email',
        'keperluan',
        'nip',
        'status',
        'tanggal_konfirmasi',
        'waktu_konfirmasi',
        'pesan',
        'pegawai_id',
        'tanggal_berkunjung',
        'jam_berkunjung'
       
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'nip', 'nip');
        
    }
}
