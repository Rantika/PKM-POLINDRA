<?php

namespace Database\Seeders;

use App\Models\Proposal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProposalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Proposal::create([
            "student_id" => 1,
            "reviewer_id" => 4,
            "lecturer_id" => 5,
            "scheme_id" => 2,
            "title" => "HOTEL BANGUN JAGAT RAYA",
            "description" => "Jakarta",
            "status" => 1,
            "year" => "2023",
            "is_confirmed" => 0
        ]);
    }
}
