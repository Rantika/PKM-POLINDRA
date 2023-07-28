<?php

namespace Database\Seeders;

use App\Models\Lecturer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LecturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Lecturer::create([
            "user_id" =>  2,
            "prody_id" => 2,
            "name" => "Mohammad Bajuri",
            "is_active" => 0
        ]);

        Lecturer::create([
            "user_id" =>  3,
            "prody_id" => 2,
            "name" => "Mohammad Hamdan",
            "is_active" => 0
        ]);

        Lecturer::create([
            "user_id" =>  4,
            "prody_id" => 2,
            "name" => "Mohammad Ronaldo",
            "is_active" => 0
        ]);
    }
}