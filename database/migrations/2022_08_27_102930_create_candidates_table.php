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
            $table->unsignedBigInteger('leader_id');
            $table->string('leader_image');
            $table->unsignedBigInteger('co_leader_id')->nullable();
            $table->string('co_leader_image');
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
            $table->bigInteger('total_votes')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('voting_id')->references('id')->on('votings')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('leader_id')->references('id')->on('students')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('co_leader_id')->references('id')->on('students')->onDelete('CASCADE')->onUpdate('CASCADE');
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
