<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        DB::table('users')->insert([
            [
                'name' => 'Administrator',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 'Administrator',
            ],
            [
                'name' => 'Lerian Febriana',
                'email' => 'kanglerian@gmail.com',
                'password' => Hash::make('lerian123'),
                'role' => 'Petugas',
            ],[
                'name' => 'Nabila Azzahra',
                'email' => 'nabil@gmail.com',
                'password' => Hash::make('nabil123'),
                'role' => 'Petugas',
            ],
        ]);
    }
}
