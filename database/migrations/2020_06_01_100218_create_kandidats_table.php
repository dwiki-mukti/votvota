<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKandidatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kandidats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_voting');
            $table->integer('id_kandidat');
            $table->string('name');
            $table->string('kelas');
            $table->string('foto');
            $table->text('visi');
            $table->text('misi');
            $table->integer('suara')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kandidats');
    }
}
