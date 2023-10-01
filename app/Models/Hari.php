<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Hari extends Model
{
    use HasFactory;
    use LogsActivity;
    protected $table = 'hari';

    protected $fillable = [
        'nama_hari', 
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logFillable();
    }
    
    public function jadwals()
    {
        return $this->hasMany(Jadwal::class, 'hari_id', 'id');
    }
}
