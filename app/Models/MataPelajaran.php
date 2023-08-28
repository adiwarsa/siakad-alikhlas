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
        'nama', 
        'kode',
        'jenjang'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
