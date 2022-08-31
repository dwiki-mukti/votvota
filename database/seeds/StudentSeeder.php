<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Student;
use App\User;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        User::create([
            'email' => 'admin@gmail.com',
            'role' => 'Admin',
            'password' => Hash::make('password'),
        ]);

        for ($i = 0; $i < 10; $i++) {
            $user = User::create([
                'email' => $faker->email,
                'password' => Hash::make('password'),
            ]);

            Student::create([
                'user_id' => $user->id,
                'nisn' => rand(100000, 99999999),
                'name' => $faker->name,
            ]);
        }
    }
}
