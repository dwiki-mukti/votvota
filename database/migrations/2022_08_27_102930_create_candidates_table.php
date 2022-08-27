<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('voting_id');
            $table->unsignedBigInteger('student_id');
            $table->string('foto');
            $table->text('visi');
            $table->text('misi');
            $table->string('total_vote')->nullable(); //encrypt total vote
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('voting_id')->references('id')->on('votings')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidates');
    }
}
