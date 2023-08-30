<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiSantri extends Model
{
    use HasFactory;
    protected $table = 'absensi';
    protected $fillable = [
        'santri_id',
        'jadwal_id',
        'keterangan',
    ];

    protected $appends = [
        'formatted_created_at',
    ];

    //Relasi disposisi ke table jadwal
    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'jadwal_id', 'id');

    }
    public function santri()
    {
        return $this->belongsTo(Santri::class, 'santri_id', 'id');

    }

     //Mengubah format tanggal created_at menjadi Hari, tanggal bulan tahun, jam menit detik
     public function getFormattedCreatedAtAttribute(): string {
        return $this->created_at->isoFormat('dddd, D MMMM YYYY, HH:mm:ss');
    }
}
