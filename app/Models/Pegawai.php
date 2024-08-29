<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';
    protected $fillable = [
        'nama',
        'nip',
        'nomor_handphone',
        'email',
        'jabatan'
    ];

    protected $appends = [
        'jumlah_terjadwal'
    ];

    public function tamu()
    {
        return $this->hasMany(Tamu::class);
    }

    public function getJumlahTerjadwalAttribute()
    {
        return Tamu::where('nip', $this->attributes['nip'])->count();
    }

}