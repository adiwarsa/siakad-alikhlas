<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kelas = [
            [
                'id' => 1,
                'wali_id' => 4,
                'kelas' => 'VII',
                'madrasah' => 'MTs. AL-IKHLAS',
                'created_at' => '2025-11-25 18:13:56',
                'updated_at' => '2025-11-25 18:13:56'
            ],
            [
                'id' => 2,
                'wali_id' => 4,
                'kelas' => 'VIII',
                'madrasah' => 'MTs. AL-IKHLAS',
                'created_at' => '2025-11-25 18:13:56',
                'updated_at' => '2025-11-25 18:13:56'
            ],
            [
                'id' => 3,
                'wali_id' => 4,
                'kelas' => 'IX',
                'madrasah' => 'MTs. AL-IKHLAS',
                'created_at' => '2025-11-25 18:13:56',
                'updated_at' => '2025-11-25 18:13:56'
            ],
            [
                'id' => 4,
                'wali_id' => 4,
                'kelas' => 'X',
                'madrasah' => 'MA. AL-IKHLAS',
                'created_at' => '2025-11-25 18:13:56',
                'updated_at' => '2025-11-25 18:13:56'
            ],
            [
                'id' => 7,
                'wali_id' => 4,
                'kelas' => 'XII',
                'madrasah' => 'MA. AL-IKHLAS',
                'created_at' => '2025-11-25 18:13:56',
                'updated_at' => '2025-11-25 18:13:56'
            ],
            [
                'id' => 8,
                'wali_id' => 4,
                'kelas' => 'XI',
                'madrasah' => 'MA. AL-IKHLAS',
                'created_at' => '2026-05-08 05:29:11',
                'updated_at' => '2026-05-08 05:29:11'
            ]
        ];

        DB::table('kelas')->insert($kelas);
    }
}
