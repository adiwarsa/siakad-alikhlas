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
        'pn_ganjil', //pengetahuan nilai ganjil
        'pn_genap', //pengetahuan nilai genap
        'ppredikat_ganjil', //pengetahuan predikat ganjil
        'ppredikat_genap', //pengetahuan predikat genap
        'kn_ganjil', //keterampilan nilai ganjil
        'kn_genap', //keterampilan nilai genap
        'kpredikat_ganjil', //keterampilan predikat ganjil
        'kpredikat_genap' //keterampilan predikat genap
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

