<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $createdAt = '2026-05-08 05:55:58';
        $updatedAtById = [
            28 => '2026-05-08 05:56:15',
            29 => '2026-05-08 05:56:35',
            30 => '2026-05-08 08:24:51',
        ];

        $jadwal = [];
        $tanggal = Carbon::parse('2026-12-05');

        foreach (range(28, 53) as $index => $id) {
            $jadwal[] = [
                'id' => $id,
                'hari_id' => 6,
                'kelas_id' => 1,
                'mapel_id' => 8,
                'guru_id' => 4,
                'tanggal' => $tanggal->copy()->addWeeks($index)->format('Y-m-d'),
                'semester' => '1',
                'jam_mulai' => '07:56:00',
                'jam_selesai' => '08:57:00',
                'status' => in_array($id, [28, 29]) ? 1 : 0,
                'created_at' => $createdAt,
                'updated_at' => $updatedAtById[$id] ?? $createdAt,
            ];
        }

        DB::table('jadwal')->insert($jadwal);
    }
}
