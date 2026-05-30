<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NilaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nilai = [
            [
                'id' => 1,
                'id_mapel' => 6,
                'kkm' => '80',
                'descpredikata' => 'Bagus',
                'descpredikatb' => 'Sedang',
                'descpredikatc' => 'Dibawah Sedang',
                'descpredikatd' => 'Jelek sekali',
                'created_at' => '2025-11-25 18:13:56',
                'updated_at' => '2025-11-26 12:23:16'
            ],
            [
                'id' => 3,
                'id_mapel' => 8,
                'kkm' => '95',
                'descpredikata' => 'ajates A',
                'descpredikatb' => 'ajates B',
                'descpredikatc' => 'ajates C',
                'descpredikatd' => 'test D',
                'created_at' => '2025-11-25 18:13:56',
                'updated_at' => '2025-11-25 18:13:56'
            ]
        ];

        DB::table('nilai')->insert($nilai);
    }
}
