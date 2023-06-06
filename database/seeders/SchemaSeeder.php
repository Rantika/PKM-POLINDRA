<?php

namespace Database\Seeders;

use App\Models\Scheme;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Scheme::create([
            "name" => "PKM Kewirausahaan",
            "short" => "PKM-K",
            "is_active" => 1
        ]);

        Scheme::create([
            "name" => "PKM Penelitian",
            "short" => "PKM-P",
            "is_active" => 1
        ]);

        Scheme::create([
            "name" => "PKM Teknologi",
            "short" => "PKM-T",
            "is_active" => 1
        ]);

        Scheme::create([
            "name" => "PKM Artikel Ilmiah",
            "short" => "PKM-AI",
            "is_active" => 1
        ]);

        Scheme::create([
            "name" => "PKM Karya Cipta",
            "short" => "PKM-KC",
            "is_active" => 1
        ]);

        Scheme::create([
            "name" => "PKM Gagasan Tertulis",
            "short" => "PKM-GT",
            "is_active" => 1
        ]);
    }
}
