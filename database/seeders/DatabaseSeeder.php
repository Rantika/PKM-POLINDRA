<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Group;
use App\Models\Lecturer;
use App\Models\Prody;
use App\Models\Proposal;
use App\Models\Reviewer;
use App\Models\Scheme;
use App\Models\Student;
use App\Models\User;
use App\Models\UsersRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(GroupSeeder::class);
        $this->call(ProdiSeeder::class);
        $this->call(UsersRoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(SchemaSeeder::class);
        $this->call(AdminSeeder::class);
    }
}
