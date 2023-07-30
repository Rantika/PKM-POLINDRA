<?php

namespace Database\Seeders;

use App\Models\TimStudent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TimStudent::create([
            "student_id" => 1,
            "tim_id" => 1
        ]);

        TimStudent::create([
            "student_id" => 2,
            "tim_id" => 2
        ]);
    }
}
