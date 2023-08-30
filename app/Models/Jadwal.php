<?php

namespace App\Models;

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
        'tanggal'
    ];

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
}
