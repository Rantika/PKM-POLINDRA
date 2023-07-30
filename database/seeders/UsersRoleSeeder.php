<?php

namespace Database\Seeders;

use App\Models\UsersRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UsersRole::create([
            'user_id' => "1",
            "role" => "Admin"
        ]);

        UsersRole::create([
            "user_id" => "2",
            "role" => "Dosen Pembimbing"
        ]);
        
        UsersRole::create([
            "user_id" => "3",
            "role" => "Dosen Pembimbing"
        ]);

        UsersRole::create([
            "user_id" => "4",
            "role" => "Dosen Pembimbing"
        ]);
    }
}
