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

        $usernames = ['dimitrije.savatic', 'dr.elena', 'mila.petrovic', 'mr.nikola', 'ana.markovic', 'james.anderson', 'sophie.laurent', 'daniel.kim', 'dr.maria.rossi', 'dr.cosmic.ray', 'oliver.bennett', 'aisha.rahman', 'lucas.miller', 'emily.carter', 'kenji.tanaka', 'dr.sofia.alvarez'];
        $firstNames = ['Dimitrije', 'Dr Elena', 'Mila', 'Mr Nikola', 'Ana', 'Dr James', 'Sophie', 'Daniel', 'Dr Maria', 'Dr Tijana', 'Oliver', 'Aisha', 'Lucas', 'Emily', 'Kenji', 'Dr Sofia'];
        $lastNames = ['Savatić', 'Petrović', 'Petrović', 'Jovanović', 'Marković', 'Anderson', 'Laurent', 'Kim', 'Rossi', 'Prodanović', 'Bennett', 'Rahman', 'Miller', 'Carter', 'Tanaka', 'Alvarez'];
        $emails = ['dimitrije.savatic@gmail.com', 'dr.elena@gmail.com', 'mila.petrovic@ict.edu.rs', 'mr.nikola@gmail.com', 'ana.markovic@yahoo.com', 'james.anderson@gmail.com', 'sophie.laurent@gmail.com', 'daniel.kim@yahoo.com', 'dr.maria.rossi@gmail.com', 'dr.cosmic.ray@gmail.com', 'oliver.bennett@yahoo.com', 'aisha.rahman@gmail.com', 'lucas.miller@gmail.com', 'emily.carter@gmail.com', 'kenji.tanaka@gmail.com', 'dr.sofia.alvarez@gmail.com'];


        for($i=0; $i < count($usernames); $i++){
            User::create([
               'username' => $usernames[$i],
               'first_name' => $firstNames[$i],
               'last_name' => $lastNames[$i],
               'email' => $emails[$i],
               'password' => Hash::make('test123'),
               'role_id' => rand(1,2)
            ]);
    }
    }
}
