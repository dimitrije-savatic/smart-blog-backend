<?php

namespace Database\Seeders;

use App\Models\Post;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        for ($i=0;$i<30;$i++){
            Post::create([
                'title' => $faker->text(20),
                'body' => $faker->text(200),
                'user_id' => rand(1,5)
            ]);
        }
    }
}
