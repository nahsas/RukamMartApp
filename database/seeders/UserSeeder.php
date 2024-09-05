<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert(["username"=>'admin',"name"=>'Admin',"password"=>md5('admin123')]);
        DB::table('users')->insert(["username"=>'Amel',"name"=>'Amelia dianti',"password"=>md5('130607')]);
    }
}
