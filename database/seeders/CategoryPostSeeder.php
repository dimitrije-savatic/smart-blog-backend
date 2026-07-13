<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0;$i<50;$i++){
            DB::table('category_post')->insert([
              'post_id' => rand(1,30),
              'category_id' => rand(1,10)
            ]);
        }
    }
}
