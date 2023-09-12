<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    use HasFactory;
    protected $table = 'mapel';
    protected $fillable = [
        'id_user',
        'id_kelas',
        'nama', 
        'kode',
        'jenjang',
        'kkm'
    ];

    public function nilai()
    {
        return $this->hasOne(Nilai::class, 'id_mapel');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }
}
