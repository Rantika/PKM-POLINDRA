<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Student::create([
            "user_id" => 5,
            "prody_id" => 3,
            "name" => "Riyan Subroto",
            "nim" => "2003055",
            "phone_number" => "2839283922"
        ]);

        Student::create([
            "user_id" => 6,
            "prody_id" => 3,
            "name" => "Maulana",
            "nim" => "2003055",
            "phone_number" => "2378242389"
        ]);
    }
}
