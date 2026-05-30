<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MataPelajaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mataPelajaran = [
            [
                'id' => 6,
                'id_user' => 4,
                'id_kelas' => 8,
                'nama' => 'Matematika',
                'kode' => 'MTK25',
                'jenjang' => 'MA. AL-IKHLAS',
                'kkm' => 70,
                'created_at' => '2025-11-25 18:13:56',
                'updated_at' => '2025-11-26 12:25:06'
            ],
            [
                'id' => 8,
                'id_user' => 4,
                'id_kelas' => 8,
                'nama' => 'Bahasa Inggris',
                'kode' => 'BING',
                'jenjang' => 'MA. AL-IKHLAS',
                'kkm' => 70,
                'created_at' => '2025-11-25 18:13:56',
                'updated_at' => '2025-11-26 12:25:26'
            ]
        ];

        DB::table('mapel')->insert($mataPelajaran);
    }
}
