<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Nilai extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = 'nilai';
    protected $fillable = [
        'id_mapel',
        'kkm',
        'descpredikata',
        'descpredikatb',
        'descpredikatc',
        'descpredikatd'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logFillable();
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'id_mapel');
    }
}
