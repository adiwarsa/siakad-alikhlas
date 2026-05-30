<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SantriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $santri = [
            [
                'id' => 1,
                'id_kelas' => 1,
                'orangtua_id' => 12,
                'nis' => '131235290117220001',
                'nama' => 'ALFIN DIANUL HAKKIs',
                'jenis_kelamin' => 'Laki - Laki',
                'tempat_lahir' => 'Smp',
                'tanggal_lahir' => '2006-11-28',
                'tahun_masuk' => 2024,
                'created_at' => '2025-11-25 18:13:56',
                'updated_at' => '2025-11-26 12:31:14'
            ],
            [
                'id' => 3,
                'id_kelas' => 1,
                'orangtua_id' => 12,
                'nis' => '189247812634',
                'nama' => 'Tuturu',
                'jenis_kelamin' => 'Laki - Laki',
                'tempat_lahir' => 'Smp',
                'tanggal_lahir' => '2000-08-25',
                'tahun_masuk' => 2021,
                'created_at' => '2025-11-25 18:13:56',
                'updated_at' => '2025-11-26 12:31:34'
            ],
            [
                'id' => 4,
                'id_kelas' => 1,
                'orangtua_id' => null,
                'nis' => '65187264817',
                'nama' => 'Tarataktum',
                'jenis_kelamin' => 'Perempuan',
                'tempat_lahir' => 'Smp',
                'tanggal_lahir' => '1998-05-31',
                'tahun_masuk' => 2021,
                'created_at' => '2025-11-25 18:13:56',
                'updated_at' => '2025-11-26 12:31:49'
            ],
            [
                'id' => 5,
                'id_kelas' => 1,
                'orangtua_id' => 14,
                'nis' => '129391283',
                'nama' => 'Tap',
                'jenis_kelamin' => 'Laki - Laki',
                'tempat_lahir' => 'Smp',
                'tanggal_lahir' => '2025-10-09',
                'tahun_masuk' => 2021,
                'created_at' => '2025-11-25 18:13:56',
                'updated_at' => '2025-11-26 12:32:00'
            ],
            [
                'id' => 6,
                'id_kelas' => 1,
                'orangtua_id' => null,
                'nis' => '202605300001',
                'nama' => 'Nabila Rahma',
                'jenis_kelamin' => 'Perempuan',
                'tempat_lahir' => 'Denpasar',
                'tanggal_lahir' => '2012-04-12',
                'tahun_masuk' => 2024,
                'created_at' => '2026-05-30 00:00:00',
                'updated_at' => '2026-05-30 00:00:00'
            ],
            [
                'id' => 7,
                'id_kelas' => 1,
                'orangtua_id' => null,
                'nis' => '202605300002',
                'nama' => 'Rizky Maulana',
                'jenis_kelamin' => 'Laki - Laki',
                'tempat_lahir' => 'Denpasar',
                'tanggal_lahir' => '2011-09-18',
                'tahun_masuk' => 2024,
                'created_at' => '2026-05-30 00:00:00',
                'updated_at' => '2026-05-30 00:00:00'
            ],
            [
                'id' => 8,
                'id_kelas' => 1,
                'orangtua_id' => null,
                'nis' => '202605300003',
                'nama' => 'Siti Aisyah',
                'jenis_kelamin' => 'Perempuan',
                'tempat_lahir' => 'Denpasar',
                'tanggal_lahir' => '2012-12-03',
                'tahun_masuk' => 2024,
                'created_at' => '2026-05-30 00:00:00',
                'updated_at' => '2026-05-30 00:00:00'
            ]
        ];

        DB::table('santri')->insert($santri);
    }
}
