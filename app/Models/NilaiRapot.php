<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiRapot extends Model
{
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
        return $this->belongsTo(Mapel::class, 'mapel_id');
    }
}

