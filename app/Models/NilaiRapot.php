<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class NilaiRapot extends Model
{
    use LogsActivity;

    protected $table = 'nilairapot';
    protected $fillable = [
        'rapot_id',
        'guru_id',
        'mapel_id',
        'nilaipengetahuan', 
        'nilaiketerampilan', 
        'predikatpengetahuan', 
        'predikatketerampilan', 
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logFillable();
    }

    public function getDeskripsiAttribute()
    {
        $predikat = $this->predikatpengetahuan;
        
        // Get the associated mapel
        $mapel = $this->mapel;

        // If the mapel exists and has a valid relationship to Nilai
        if ($mapel && $mapel->nilai) {
            $deskripsiMapping = [
                'A' => $mapel->nilai->descpredikata,
                'B' => $mapel->nilai->descpredikatb,
                'C' => $mapel->nilai->descpredikatc,
                'D' => $mapel->nilai->descpredikatd,
            ];

            // Check if the predikat exists in the mapping array, otherwise use a default value.
            return $deskripsiMapping[$predikat] ?? 'No Description Available';
        }

        return 'Belum Ada Deskripsi';
    }


    public function rapot()
    {
        return $this->belongsTo(Raport::class, 'rapot_id');
    }

    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }

    public function mapel()
    {
        return $this->belongsTo(MataPelajaran::class, 'mapel_id');
    }
}

