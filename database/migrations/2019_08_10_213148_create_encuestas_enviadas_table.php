<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEncuestasEnviadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_encuestas_enviadas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('promocion');
            $table->integer('create_user_id')->unsigned();
            $table->integer('update_user_id')->unsigned();
            $table->string('estado');
            $table->foreign('create_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('update_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('encuestas_enviadas');
    }
}
