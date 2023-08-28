<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Santri extends Model
{
    use HasFactory;

    protected $table = 'santri';
    protected $fillable = [
        'id_kelas',
        'nis',
        'nama', 
        'jenis_kelamin',
        'tempat_lahir', 
        'tanggal_lahir', 
        'tahun_masuk', 
    ];
    protected $appends = [
        'formatted_tanggal_lahir', 
        'formatted_created_at',
        'formatted_updated_at',
    ];
    
    //Mengubah format tanggal tanggallahir menjadi Hari, tanggal bulan tahun, 
    public function getFormattedTanggalLahirAttribute(): string {
        return Carbon::parse($this->tanggal_lahir)->isoFormat('D MMMM YYYY');
    }

     //Mengubah format tanggal created_at menjadi Hari, tanggal bulan tahun, jam menit detik
    public function getFormattedCreatedAtAttribute(): string {
        return $this->created_at->isoFormat('dddd, D MMMM YYYY, HH:mm:ss');
    }

    //Mengubah format tanggal updated_at menjadi Hari, tanggal bulan tahun, jam menit detik
    public function getFormattedUpdatedAtAttribute(): string {
        return $this->updated_at->isoFormat('dddd, D MMMM YYYY, HH:mm:ss');
    }
    
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id');

    }
}
