<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AbsensiSantriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $absensi = [
            [
                'id' => 23,
                'santri_id' => 5,
                'jadwal_id' => 29,
                'keterangan' => 'Alpha',
                'semester' => '1',
                'created_at' => '2026-05-08 05:56:35',
                'updated_at' => '2026-05-08 05:56:35'
            ],
            [
                'id' => 24,
                'santri_id' => 5,
                'jadwal_id' => 29,
                'keterangan' => 'Sakit',
                'semester' => '1',
                'created_at' => '2026-05-08 05:56:35',
                'updated_at' => '2026-05-08 05:56:35'
            ],
            [
                'id' => 27,
                'santri_id' => 5,
                'jadwal_id' => 30,
                'keterangan' => 'Izin',
                'semester' => '1',
                'created_at' => '2026-05-08 08:24:35',
                'updated_at' => '2026-05-08 08:24:35'
            ]
        ];

        DB::table('absensi')->insert($absensi);
    }
}
