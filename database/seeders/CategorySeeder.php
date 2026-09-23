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
        $categories = ['Astronomy & Space', 'Biology', 'Physics', 'Chemistry', 'Computer Science', 'Earth & Climate Science', 'Medicine & Neuroscience', 'Engineering & Technology', 'Mathematics', 'Scientific Method & Society'];

        foreach ($categories as $c){
            Category::create(['name' => $c]);
        }
    }
}
