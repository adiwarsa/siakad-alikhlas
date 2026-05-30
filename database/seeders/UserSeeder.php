<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert users from the original SQL dump
        $users = [
            [
                'id' => 1,
                'id_detail' => null,
                'name' => 'Admin Taro',
                'email' => 'admin@alikhlas.com',
                'username' => 'admin',
                'email_verified_at' => '2025-08-28 01:10:31',
                'password' => Hash::make('password'),
                'created_at' => '2025-08-28 01:10:31',
                'updated_at' => '2025-09-20 14:43:14',
            ],
            [
                'id' => 4,
                'id_detail' => 2,
                'name' => 'Jufri, S.Pd',
                'email' => 'jufri@gmail.com',
                'username' => 'jufri',
                'email_verified_at' => '2025-09-17 16:20:54',
                'password' => Hash::make('password'),
                'created_at' => '2025-08-28 13:45:33',
                'updated_at' => '2025-09-17 16:20:54',
            ],
            [
                'id' => 12,
                'id_detail' => 4,
                'name' => 'bapaktuturu',
                'email' => 'ortu@gmail.com',
                'username' => 'orangtua',
                'email_verified_at' => '2026-01-09 22:24:43',
                'password' => Hash::make('password'),
                'created_at' => '2025-09-17 15:34:45',
                'updated_at' => '2026-01-09 22:24:44',
            ],
            [
                'id' => 14,
                'id_detail' => 6,
                'name' => 'pak tap',
                'email' => 'ortutap@gmail.com',
                'username' => 'bapaktap',
                'email_verified_at' => '2026-05-08 05:53:25',
                'password' => Hash::make('password'),
                'created_at' => '2026-05-08 05:53:25',
                'updated_at' => '2026-05-08 05:53:25',
            ],
            [
                'id' => 15,
                'id_detail' => 7,
                'name' => 'azrul',
                'email' => 'azrul@gmail.com',
                'username' => 'azrul',
                'email_verified_at' => '2026-05-08 08:22:31',
                'password' => Hash::make('password'),
                'created_at' => '2026-05-08 08:22:31',
                'updated_at' => '2026-05-08 08:22:31',
            ],
        ];

        DB::table('users')->insert($users);

        // Insert role assignments from the original SQL dump
        $roleAssignments = [
            [
                'role_id' => 1,
                'model_type' => 'App\Models\User',
                'model_id' => 1
            ],
            [
                'role_id' => 2,
                'model_type' => 'App\Models\User',
                'model_id' => 4
            ],
            [
                'role_id' => 3,
                'model_type' => 'App\Models\User',
                'model_id' => 12
            ],
            [
                'role_id' => 3,
                'model_type' => 'App\Models\User',
                'model_id' => 14
            ],
            [
                'role_id' => 2,
                'model_type' => 'App\Models\User',
                'model_id' => 15
            ]
        ];

        DB::table('model_has_roles')->insert($roleAssignments);
    }
}
