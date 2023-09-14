<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';
    
    protected $fillable = [
        'wali_id', 'kelas', 'madrasah',
    ];

    public function guruwali()
    {
      return $this->belongsTo(User::class, 'wali_id', 'id');
    }
    
    public function santris()
    {
        return $this->hasMany(Santri::class, 'id_kelas', 'id');
    }
    public function mapels()
    {
        return $this->hasMany(MataPelajaran::class, 'id_kelas');
        
    }
}
