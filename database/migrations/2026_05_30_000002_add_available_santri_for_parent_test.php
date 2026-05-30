<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddAvailableSantriForParentTest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('santri') || !Schema::hasTable('kelas')) {
            return;
        }

        if (!Schema::hasColumn('santri', 'orangtua_id')) {
            return;
        }

        if (DB::table('santri')->count() === 0) {
            return;
        }

        $kelasId = DB::table('kelas')->orderBy('id')->value('id');

        if (!$kelasId) {
            return;
        }

        foreach ($this->availableSantriForParentTestRows($kelasId) as $row) {
            if (DB::table('santri')->where('nis', $row['nis'])->exists()) {
                continue;
            }

            DB::table('santri')->insert($row);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Keep santri rows to avoid deleting data that may already be assigned to a parent.
    }

    private function availableSantriForParentTestRows($kelasId)
    {
        return [
            [
                'id_kelas' => $kelasId,
                'orangtua_id' => null,
                'nis' => '202605300001',
                'nama' => 'Nabila Rahma',
                'jenis_kelamin' => 'Perempuan',
                'tempat_lahir' => 'Denpasar',
                'tanggal_lahir' => '2012-04-12',
                'tahun_masuk' => 2024,
                'created_at' => '2026-05-30 00:00:00',
                'updated_at' => '2026-05-30 00:00:00',
            ],
            [
                'id_kelas' => $kelasId,
                'orangtua_id' => null,
                'nis' => '202605300002',
                'nama' => 'Rizky Maulana',
                'jenis_kelamin' => 'Laki - Laki',
                'tempat_lahir' => 'Denpasar',
                'tanggal_lahir' => '2011-09-18',
                'tahun_masuk' => 2024,
                'created_at' => '2026-05-30 00:00:00',
                'updated_at' => '2026-05-30 00:00:00',
            ],
            [
                'id_kelas' => $kelasId,
                'orangtua_id' => null,
                'nis' => '202605300003',
                'nama' => 'Siti Aisyah',
                'jenis_kelamin' => 'Perempuan',
                'tempat_lahir' => 'Denpasar',
                'tanggal_lahir' => '2012-12-03',
                'tahun_masuk' => 2024,
                'created_at' => '2026-05-30 00:00:00',
                'updated_at' => '2026-05-30 00:00:00',
            ],
        ];
    }
}
