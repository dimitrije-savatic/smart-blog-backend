<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0;$i<70;$i++){
            DB::table('post_categories')->insert([
              'post_id' => rand(1,5),
              'categories_id' => rand(1,10)
            ]);
        }
    }
}
