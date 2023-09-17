<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $table = 'userdetail';
    protected $fillable = [
        'user_id', // Include user_id in the fillable array
        'santri_id',
        'noinduk',
        'nama_lengkap',
        'nohp',
        'alamat',
        'tempat_lahir',
        'tanggal_lahir',
    ];

    // Define the reverse relationship to User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function anak()
    {
        return $this->belongsTo(Santri::class, 'santri_id');
    }
}
