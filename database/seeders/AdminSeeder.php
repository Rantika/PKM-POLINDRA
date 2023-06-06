<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            "user_id" => 1,
            "name" => "Administrator",
            "nip" => "2003077",
            "phone_number" => "2839283",
            "is_active" => 1
        ]);
    }
}
