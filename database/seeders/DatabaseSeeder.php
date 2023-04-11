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
        $users = [
            [
                'email'     => 'admin@gmail.com',
                'password'  => bcrypt('123456'),
                'role'      => 'admin',
            ],
            [
                'email'     => 'reviewer@gmail.com',
                'password'  => bcrypt('123456'),
                'role'      => 'reviewer',
            ],
            [
                'email'     => 'dosbing@gmail.com',
                'password'  => bcrypt('123456'),
                'role'      => 'lecturer',
            ],
            [
                'email'     => 'tim@gmail.com',
                'password'  => bcrypt('123456'),
                'role'      => 'student',
            ],
        ];

        $groups = [
            [
                'name'      => 'Teknik Informatika',
                'is_active' => true,
            ],
            [
                'name'      => 'Teknik Mesin',
                'is_active' => true,
            ],
            [
                'name'      => 'Teknik Pendingin dan Tata Udara',
                'is_active' => true,
            ],
        ];

        $prodies = [
            [
                'name'      => 'D3 Teknik Informatika',
                'short'     => 'TI',
                'is_active' => true,
            ],
            [
                'name'      => 'D3 Teknik Mesin',
                'short'     => 'TM',
                'is_active' => true,
            ],
            [
                'name'      => 'D3 Teknik Pendingin dan Tata Udara',
                'short'     => 'TP',
                'is_active' => true,
            ],
            [
                'name'      => 'D3 Teknik Keperawatan',
                'short'     => 'KP',
                'is_active' => true,
            ],
            [
                'name'      => 'D4 Rekayasa Perangkat Lunak',
                'short'     => 'RPL',
                'is_active' => true,
            ],
            [
                'name'      => 'D4 Perancangan Manufaktur',
                'short'     => 'PM',
                'is_active' => true,
            ],
        ];

        $schemes = [
            [
                'name'  => 'PKM Penelitian',
                'short' => 'PKM-P',
                'is_active' => true,
            ],
            [
                'name'  => 'PKM Kewirausahaan',
                'short' => 'PKM-K',
                'is_active' => true,
            ],
            [
                'name'  => 'PKM Teknologi',
                'short' => 'PKM-T',
                'is_active' => true,
            ],
            [
                'name'  => 'PKM Artikel Ilmiah',
                'short' => 'PKM-AI',
                'is_active' => true,
            ],
            [
                'name'  => 'PKM Karya Cipta',
                'short' => 'PKM-KC',
                'is_active' => true,
            ],
            [
                'name'  => 'PKM Gagasan Tertulis',
                'short' => 'PKM-GT',
                'is_active' => true,
            ]
        ];

        try {
            DB::beginTransaction();
            foreach ($users as $user){
                $data[$user['role']] = User::updateOrCreate(
                    ['role' => $user['role']],
                    $user
                );
            }
            foreach ($groups as $group){
                $data[$group['name']] = Group::updateOrCreate(
                    ['name' => $group['name']],
                    $group
                );
            }
            foreach ($prodies as $prody){
                if(in_array($prody['name'], ['D3 Teknik Informatika', 'D3 Teknik Keperawatan', 'D4 Rekayasa Perangkat Lunak'])){
                    $groupID = $data['Teknik Informatika']->id;
                }else if(in_array($prody['name'], ['D3 Teknik Mesin', 'D4 Perancangan Manufaktur'])){
                    $groupID = $data['Teknik Mesin']->id;
                }else{
                    $groupID = $data['Teknik Pendingin dan Tata Udara']->id;
                } // if : else :

                $data[$prody['short']] = Prody::updateOrCreate(
                    ['short' => $prody['short']],
                    $prody
                    + [
                        'group_id'  => $groupID
                    ]
                );
            }
            foreach ($schemes as $scheme){
                $data[$scheme['short']] = Scheme::updateOrCreate(
                    ['short' => $scheme['short']],
                    $scheme
                );
            }

            Admin::updateOrCreate(
            ['phone_number'  => '087777777777'],
            [
                'user_id'       => $data['admin']->id,
                'name'          => 'Jamaludin',
                'nip'          => '199902387737234',
                'is_active'     => true,
            ]);

            $lecturer = Lecturer::updateOrCreate(
            ['nip'          => '1990052100001'],
            [
                'user_id'       => $data['lecturer']->id,
                'prody_id'      => $data['TI']->id,
                'name'          => 'Munengsih Sari Bunga',
                'phone_number'  => '087777777777',
                'is_active'     => true,
                'is_reviewer'   => false,
                'is_dosbing'    => true,
            ]);

            $student = Student::updateOrCreate(
            ['nim'          => '1903000'],
            [
                'user_id'       => $data['student']->id,
                'prody_id'      => $data['TI']->id,
                'name'          => 'Annisa Khusnul Laily',
                'phone_number'  => '087777777777',
                'year'          => '2022',
                'is_active'     => true,
            ]);

            Proposal::create([
                'student_id'    => $student->id,
                'lecturer_id'   => $lecturer->id,
                'scheme_id'     => $data['PKM-K']->id,
                'title'         => 'Pengolahan Buah nanas dengan apel',
                'status'        => 0,
                'year'          => '2022',
                'is_confirmed'  => false,
            ]);

            DB::commit();
            dd('Success Seeding');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($data, $e->getMessage());
        }
    }
}
