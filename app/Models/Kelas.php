<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';
    
    protected $fillable = [
        'kelas', 'madrasah',
    ];

    public function santris()
    {
        return $this->hasMany(Santri::class, 'id_kelas', 'id');
    }
}
