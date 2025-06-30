<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        for($i=0;$i < 5; $i++){
            User::create([
               'username' => $faker->name(),
               'first_name' => $faker->firstName,
               'last_name' => $faker->lastName,
               'email' => $faker->email,
               'password' => Hash::make('test123'),
               'role_id' => rand(1,2)
            ]);
    }
    }
}
