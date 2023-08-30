<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal';
    protected $fillable = [
        'hari_id', 
        'kelas_id',
        'mapel_id', 
        'guru_id', 
        'jam_mulai', 
        'jam_selesai', 
        'tanggal',
        'status'
    ];
    protected $appends = [
      'formatted_tanggal', 
      'formatted_created_at',
      'formatted_updated_at',
  ];
  
    //Mengubah format tanggal tanggal menjadi Hari, tanggal bulan tahun, 
    public function getFormattedTanggalAttribute(): string {
        return Carbon::parse($this->tanggal)->isoFormat('D MMMM YYYY');
    }

    //Mengubah format tanggal created_at menjadi Hari, tanggal bulan tahun, jam menit detik
    public function getFormattedCreatedAtAttribute(): string {
        return $this->created_at->isoFormat('dddd, D MMMM YYYY, HH:mm:ss');
    }

    //Mengubah format tanggal updated_at menjadi Hari, tanggal bulan tahun, jam menit detik
    public function getFormattedUpdatedAtAttribute(): string {
        return $this->updated_at->isoFormat('dddd, D MMMM YYYY, HH:mm:ss');
    }

    public function hari()
    {
      return $this->belongsTo(Hari::class, 'hari_id', 'id');
    }
  
    public function kelas()
    {
      return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }
  
    public function mapel()
    {
      return $this->belongsTo(MataPelajaran::class, 'mapel_id', 'id');
    }
  
    public function guru()
    {
      return $this->belongsTo(User::class, 'guru_id', 'id');
    }

    public function absensi()
    {
        return $this->hasMany(AbsensiSantri::class, 'jadwal_id', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        // Menghapus record Revisi yang berelasi ketika menghapus jadwal
        static::deleting(function ($jadwal) {
            $jadwal->absensi()->delete();
        });
    }
}
