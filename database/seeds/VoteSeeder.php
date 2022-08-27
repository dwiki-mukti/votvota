<?php

use App\Candidate;
use App\Student;
use App\User;
use App\Voter;
use App\Voting;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class VoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker= Faker::create('id_ID');

        for ($i=0; $i < 5; $i++) {
            $user = User::create([
                'email' => $faker->email,
                'password' => Hash::make('password'),
            ]);

            $student = Student::create([
                'user_id' => $user->id,
                'nisn' => rand(100000, 99999999),
                'name' => $faker->name,
                'batch' => 1
            ]);

            $voting = Voting::create([
                'title' => $faker->sentence,
                'end_at' => Carbon::now()
            ]);

            Candidate::create([
                'voting_id' => $voting->id,
                'student_id' => $student->id,
                'foto' => 'hello.png',
                'visi' => $faker->text,
                'misi' => $faker->text,
                'total_vote' => rand(1, 20)
            ]);
            
            Voter::create([
                'voting_id' => $voting->id,
                'student_id' => $student->id,
                'status' => 1
            ]);
        }
    }
}
