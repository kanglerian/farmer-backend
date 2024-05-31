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
                'level' => 1,
            ],
            [
                'name' => 'Lerian Febriana',
                'email' => 'kanglerian@gmail.com',
                'password' => Hash::make('lerian123'),
                'level' => 0,
            ],[
                'name' => 'Nabila Azzahra',
                'email' => 'nabil@gmail.com',
                'password' => Hash::make('nabil123'),
                'level' => 0,
            ],
        ]);
    }
}
