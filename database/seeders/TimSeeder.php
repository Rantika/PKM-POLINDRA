<?php

namespace Database\Seeders;

use App\Models\Tim;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tim::create([
            "user_id" => 5,
            "nama_tim" => "TIM PKM POLINDRA"
        ]);

        Tim::create([
            "user_id" => 6,
            "nama_tim" => "TIM JAGAT RAYA"
        ]);
    }
}
