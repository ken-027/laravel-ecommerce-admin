<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('admin')->insert([
            [
                'group_id' => 1,
                'name' => 'admin',
                'username' => 'admin',
                'password' => Hash::make('admin'),
                'email' => 'abe@dawser.com',
                'type' => 'super_admin',
                'pass_change_token' => '',
                'added_date' => new \DateTime(),
                'uploaded_date' => new \DateTime(),
                'status' => 1
            ],
            [
                'group_id' => 2,
                'name' => 'client admin',
                'username' => 'client',
                'password' => Hash::make('admin'),
                'email' => 'admin@test.com',
                'type' => 'admin',
                'pass_change_token' => '',
                'added_date' => new \DateTime(),
                'uploaded_date' => new \DateTime(),
                'status' => 1
            ]
        ]);
    }
}
