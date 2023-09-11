<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rapot extends Model
{
    use HasFactory;
    protected $table = 'rapot';
    protected $fillable = [
        'santri_id',
        'guru_id',
        'kelas_id', 
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

    public function santri()
    {
        return $this->belongsTo(Santri::class, 'santri_id');
    }

    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'mapel_id');
    }
}
