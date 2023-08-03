<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\Role::factory()->create(
        DB::table('roles')->insert(
            [[
            'role' => 'admin',
            'level' => 99
            ],
            [
                'role' => 'pegawai',
                'level' => 1
            ], [
                'role' => 'manager',
                'level' => 2
            ],[
                'role' => 'supervisor',
                'level' => 3
            ],[
                'role' => 'direktur',
                'level' => 4
            ],[
                'role' => 'direktur_utama',
                'level' => 5
            ]]
        );

        DB::table('depts')->insert(
            [
                [
                    'name' => 'kantor pusat',
                    'location' => 'jl. semangka',
                    'type' => 'headquarter',
                ],
                [
                    'name' => 'tambang jl. jeruk',
                    'location' => 'jl. jeruk',
                    'type' => 'mine',
                ],
                [
                    'name' => 'kantor cabang jl. apel',
                    'location' => 'jl. apel',
                    'type' => 'branch',
                ],
                [
                    'name' => 'tambang jl. pir',
                    'location' => 'jl. pir',
                    'type' => 'mine',
                ],
                [
                    'name' => 'tambang jl. anggur',
                    'location' => 'jl. anggur',
                    'type' => 'mine',
                ],
            ]
        );

        DB::table('vehicles')->insert(
            [
                [
                    'vehicle' => 'Truk Hino',
                    'type' => 'barang',
                    'status' => 'tersedia',
                    'is_loan' => true
                ],
                [
                    'vehicle' => 'Toyota Alphard',
                    'type' => 'orang',
                    'status' => 'tersedia',
                    'is_loan' => false
                ],
                [
                    'vehicle' => 'Daihatsu Xenia',
                    'type' => 'orang',
                    'status' => 'tersedia',
                    'is_loan' => false
                ],
                [
                    'vehicle' => 'Pickup L300',
                    'type' => 'barang',
                    'status' => 'tersedia',
                    'is_loan' => false
                ],
            ]
        );

        DB::table('users')->insert(
            [
                [
                    'name' => 'Anto',
                    'email' => 'anto@gmail.com',
                    'password' => Hash::make('password'),
                    'role_id' => 2,
                    'dept_id' => 5
                ],
                [
                    'name' => 'Admin',
                    'email' => 'admin@gmail.com',
                    'password' => Hash::make('password'),
                    'role_id' => 1,
                    'dept_id' => 1
                ],
                [
                    'name' => 'Bambang',
                    'email' => 'bambang@gmail.com',
                    'password' => Hash::make('password'),
                    'role_id' => 5,
                    'dept_id' => 1
                ],
                [
                    'name' => 'Sari',
                    'email' => 'sari@gmail.com',
                    'password' => Hash::make('password'),
                    'role_id' => 4,
                    'dept_id' => 3
                ],
                [
                    'name' => 'Tono',
                    'email' => 'tono@gmail.com',
                    'password' => Hash::make('password'),
                    'role_id' => 6,
                    'dept_id' => 1
                ],
                [
                    'name' => 'Gito',
                    'email' => 'gito@gmail.com',
                    'password' => Hash::make('password'),
                    'role_id' => 2,
                    'dept_id' => 4
                ],
                [
                    'name' => 'Sutanto',
                    'email' => 'sutantog@gmail.com',
                    'password' => Hash::make('password'),
                    'role_id' => 3,
                    'dept_id' => 3
                ],
            ]
        );

        DB::table('vehicle_maintains')->insert([
            [
                'user_id' => 1,
                'vehicle_id' => 2,
                'description' =>'ganti oli',
                'cost' => 400000,
                'created_at' => '2023-09-10',
                'updated_at' => '2023-09-10',
            ],
            [
                'user_id' => 1,
                'vehicle_id' => 3,
                'description' =>'ganti ban',
                'cost' => 1000000,
                'created_at' => '2023-10-10',
                'updated_at' => '2023-10-10',
            ],
            [
                'user_id' => 1,
                'vehicle_id' => 2,
                'description' =>'ganti ban',
                'cost' => 1500000,
                'created_at' => '2023-10-11',
                'updated_at' => '2023-10-11',
            ],
            [
                'user_id' => 1,
                'vehicle_id' => 4,
                'description' =>'ganti oli',
                'cost' => 300000,
                'created_at' => '2023-10-11',
                'updated_at' => '2023-10-11',
            ],
        ]);

        DB::table('transport_usages')->insert([
            [
                'user_id' => 1,
                'vehicle_id' => 1,
                'agree_id' => 3,
                'is_agree' => true,
                'is_complete' => true,
                'need' => 'angkut barang',
                'driver' => 'agus',
                'booking_date' => '2023-08-09',
                'gas' => 1000000,
                'status' => 'disetujui',
                'created_at' => '2023-08-09',
                'updated_at' => '2023-08-09',
            ],
            [
                'user_id' => 1,
                'vehicle_id' => 4,
                'agree_id' => 3,
                'is_agree' => true,
                'is_complete' => true,
                'need' => 'angkut barang',
                'driver' => 'agus',
                'booking_date' => '2023-08-15',
                'gas' => 500000,
                'status' => 'disetujui',
                'created_at' => '2023-08-10',
                'updated_at' => '2023-08-11',
            ],
            [
                'user_id' => 6,
                'vehicle_id' => 2,
                'agree_id' => 3,
                'is_agree' => false,
                'is_complete' => false,
                'need' => 'angkut orang',
                'gas' => 0,
                'driver' => 'tono',
                'booking_date' => '2023-08-10',
                'status' => 'tidak_disetujui',
                'created_at' => '2023-08-09',
                'updated_at' => '2023-08-09',
            ],
        ]);
    }
}
