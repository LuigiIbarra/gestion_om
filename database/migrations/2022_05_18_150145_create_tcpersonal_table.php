<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTcpersonalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tcpersonal', function (Blueprint $table) {
            $table->increments('iid_personal');
            $table->string('cnombre_personal',50)->nullable();
            $table->string('cpaterno_personal',50)->nullable();
            $table->string('cmaterno_personal',50)->nullable();
            $table->integer('iid_puesto')->unsigned()->nullable();
            $table->integer('iid_adscripcion')->unsigned()->nullable();
            $table->string('ccorreo_electronico',150)->nullable();
            $table->integer('iestatus')->default(1);
            $table->integer('iid_usuario')->nullable();
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
        Schema::dropIfExists('tcpersonal');
    }
}
