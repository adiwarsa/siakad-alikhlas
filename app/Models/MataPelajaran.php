<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class MataPelajaran extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = 'mapel';
    protected $fillable = [
        'id_user',
        'id_kelas',
        'nama', 
        'kode',
        'jenjang',
        'kkm'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logFillable();
    }

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

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($mapel) {
            // Delete related 'nilai' records
            $mapel->nilai()->delete();
        });
    }
}
