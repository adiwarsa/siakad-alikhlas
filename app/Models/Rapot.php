<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Rapot extends Model
{
    use HasFactory;
    use LogsActivity;
    
    protected $table = 'rapot';
    protected $fillable = [
        'santri_id',
        'wali_id',
        'kelas_id', 
        'semester', 
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logFillable();
    }

    public function santri()
    {
        return $this->belongsTo(Santri::class, 'santri_id');
    }

    public function guruwali()
    {
      return $this->belongsTo(User::class, 'wali_id', 'id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function nilaiRapots()
    {
        return $this->hasMany(NilaiRapot::class, 'rapot_id');
    }

    // Define a cascade delete relationship
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($rapot) {
            // Delete the associated nilaiRapots
            $rapot->nilaiRapots()->delete();
        });
    }
}
