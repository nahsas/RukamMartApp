<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class unitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('units')->insert(['name'=>'Pcs']);
        DB::table('units')->insert(['name'=>'Pack']);
        DB::table('units')->insert(['name'=>'Box']);
    }
}
