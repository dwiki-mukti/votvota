<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker= Faker::create();
    	for ($i=0; $i < 10 ; $i++) { 
	    	DB::table('students')->insert([
	    		'nisn'=> rand(1, 1000),
	    		'nama' => $faker->name,
	    		'kelas' => 'XI RPL A',
	    		'status' => 0
	    	]);
    	}
    }
}
