<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Kelas extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = 'kelas';
    
    protected $fillable = [
        'wali_id', 'kelas', 'madrasah',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logFillable();
    }

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
