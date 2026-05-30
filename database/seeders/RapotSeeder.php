<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RapotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rapot = [
            [
                'id' => 8,
                'santri_id' => 5,
                'wali_id' => 4,
                'kelas_id' => 7,
                'semester' => '1',
                'created_at' => '2025-11-25 18:13:56',
                'updated_at' => '2025-11-25 18:13:56'
            ],
            [
                'id' => 9,
                'santri_id' => 5,
                'wali_id' => 4,
                'kelas_id' => 7,
                'semester' => '2',
                'created_at' => '2025-11-25 18:13:56',
                'updated_at' => '2025-11-25 18:13:56'
            ]
        ];

        DB::table('rapot')->insert($rapot);
    }
}
