<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('devices')->insert([
            [
                'name' => 'Pompa Pintar',
                'status' => 'Master',
                'condition' => 'Good',
                'created_at' => Carbon::now()->setTimezone('Asia/Jakarta'),
                'updated_at' => Carbon::now()->setTimezone('Asia/Jakarta'),
            ],[
                'name' => 'Pompa 1',
                'status' => 'Pompa',
                'condition' => 'Good',
                'created_at' => Carbon::now()->setTimezone('Asia/Jakarta'),
                'updated_at' => Carbon::now()->setTimezone('Asia/Jakarta'),
            ],[
                'name' => 'Pompa 2',
                'status' => 'Pompa',
                'condition' => 'Good',
                'created_at' => Carbon::now()->setTimezone('Asia/Jakarta'),
                'updated_at' => Carbon::now()->setTimezone('Asia/Jakarta'),
            ],
        ]);
    }
}
