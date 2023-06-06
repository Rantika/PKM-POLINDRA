<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Group::create([
            "name" => "Teknik Informatika",
            "is_active" => 1
        ]);

        Group::create([
            "name" => "Teknik Mesin",
            "is_active" => 1
        ]);

        Group::create([
            "name" => "Teknik Pendingin dan Tata Udara",
            "is_active" => 1
        ]);
    }
}
