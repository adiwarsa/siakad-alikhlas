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
        'pn_ganjil', 
        'pn_genap', 
        'predikatn_ganjil', 
        'predikatn_genap',
        'pp_ganjil', 
        'pp_genap', 
        'predikatp_ganjil', 
        'predikatp_genap'
    ];
}
