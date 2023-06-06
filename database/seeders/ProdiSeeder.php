<?php

namespace Database\Seeders;

use App\Models\Prody;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Prody::create([
            "group_id" => 1,
            "short" => "TI",
            "name" => "D3 Teknik Informatika",
            "is_active"=> 1
        ]);

        Prody::create([
            "group_id" => 1,
            "short" => "RPL",
            "name" => "D4 Rekayasa Perangkat Lunak",
            "is_active"=> 1
        ]);

        Prody::create([
            "group_id" => 2,
            "short" => "TM",
            "name" => "D3 Teknik Mesin",
            "is_active"=> 1
        ]);

        Prody::create([
            "group_id" => 2,
            "short" => "PM",
            "name" => "D4 Perancangan Manufaktur",
            "is_active"=> 1
        ]);
    }
}
