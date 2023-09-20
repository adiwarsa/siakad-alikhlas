<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class UserDetail extends Model
{
    use LogsActivity;

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

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logFillable();
        // Chain fluent methods for configuration options
    }

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
