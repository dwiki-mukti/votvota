<?php

use App\Candidate;
use App\Student;
use App\Voter;
use App\Voting;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

        for ($v=0; $v < 5; $v++) {
            $voting = Voting::create([
                'title' => $faker->sentence,
                'end_at' => Carbon::now()->timestamp
            ]);

            $students = Student::whereBetween('batch', [1, 3]);

            // candidate
            for ($i=0; $i < rand(1, 4); $i++) {
                $candidates = $students->inRandomOrder('id')
                                ->limit(2)->get(['id']);
                Candidate::create([
                    'voting_id' => $voting->id,
                    'leader_id' => $candidates[0]->id,
                    'leader_image' => 'hello.png',
                    'co_leader_id' => $candidates[1]->id,
                    'co_leader_image' => 'hello.png',
                    'visi' => $faker->text,
                    'misi' => $faker->text,
                ]);
            }
            
            // voter
            $total_voters = $students->count();
            for ($voter=1; $voter <= $total_voters; $voter++) {
                $randCandidate = Candidate::where('voting_id', $voting->id)->inRandomOrder('id')->first(['id']);
                Voter::create([
                    'voting_id' => $voting->id,
                    'candidate_id' => $randCandidate->id,
                    'token' => Hash::make(Str::random(4))
                ]);
            }
        }
    }
}
