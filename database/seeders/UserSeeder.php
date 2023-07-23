<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => "admin@gmail.com",
            "password" => bcrypt("123456"),
            "id_hak_akses" => 1
        ]);

        User::create([
            "email" => "fauzi@gmail.com",
            "password" => bcrypt("123456"),
            "id_hak_akses" => 2
        ]);

        User::create([
            "email" => "bambang@gmail.com",
            "password" => bcrypt("123456"),
            "id_hak_akses" => 3
        ]);

        User::create([
            "email" => "judika@gmail.com",
            "password" => bcrypt("123456"),
            "id_hak_akses" => 4
        ]);
    }
}
