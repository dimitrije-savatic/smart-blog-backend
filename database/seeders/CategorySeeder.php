<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['fiction', 'american', 'crime', 'english', 'french', 'love', 'mystery', 'classic', 'history', 'magical'];

        foreach ($categories as $c){
            Category::create(['name' => $c]);
        }
    }
}
