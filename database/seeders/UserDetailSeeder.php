<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userDetails = [
            [
                'id' => 2,
                'user_id' => 4,
                'noinduk' => '8591238192839128',
                'nama_lengkap' => 'tesaja ini brok nama lengkap',
                'nohp' => '10294819024',
                'alamat' => 'Jl. Trengguli GG Pipit no 55 C',
                'tempat_lahir' => 'Kota Denpasar',
                'tanggal_lahir' => '2025-09-17',
                'created_at' => '2025-11-25 18:13:56',
                'updated_at' => '2025-11-25 18:13:56'
            ],
            [
                'id' => 4,
                'user_id' => 12,
                'noinduk' => '01238172893',
                'nama_lengkap' => 'josephine 5apar 5aidah',
                'nohp' => '1892731823',
                'alamat' => 'Jl. Trengguli GG Pipit no 55 C',
                'tempat_lahir' => 'denpasar',
                'tanggal_lahir' => '2025-09-18',
                'created_at' => '2025-11-25 18:13:56',
                'updated_at' => '2025-11-25 18:13:56'
            ],
            [
                'id' => 6,
                'user_id' => 14,
                'noinduk' => '1234',
                'nama_lengkap' => 'bapak tap',
                'nohp' => '085334752704',
                'alamat' => 'Jl. Trengguli GG Pipit no 55 C',
                'tempat_lahir' => 'Smp',
                'tanggal_lahir' => '1997-12-05',
                'created_at' => '2026-05-08 05:53:25',
                'updated_at' => '2026-05-08 05:53:25'
            ],
            [
                'id' => 7,
                'user_id' => 15,
                'noinduk' => '1234',
                'nama_lengkap' => 'azrul muttQIN',
                'nohp' => '085334752704',
                'alamat' => 'Jl. Trengguli GG Pipit no 55 C',
                'tempat_lahir' => 'denpasar',
                'tanggal_lahir' => '1998-12-07',
                'created_at' => '2026-05-08 08:22:31',
                'updated_at' => '2026-05-08 08:22:31'
            ]
        ];

        DB::table('userdetail')->insert($userDetails);
        
        // Update users table to link with userdetail
        DB::table('users')->where('id', 4)->update(['id_detail' => 2]);
        DB::table('users')->where('id', 12)->update(['id_detail' => 4]);
        DB::table('users')->where('id', 14)->update(['id_detail' => 6]);
        DB::table('users')->where('id', 15)->update(['id_detail' => 7]);
    }
}
