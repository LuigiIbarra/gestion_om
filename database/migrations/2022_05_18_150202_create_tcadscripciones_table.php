<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTcadscripcionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tcadscripciones', function (Blueprint $table) {
            $table->increments('iid_adscripcion');
            $table->string('cdescripcion_adscripcion',300);
            $table->string('csiglas',20)->nullable();
            $table->integer('iid_tipo_area')->default(9);
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
        Schema::dropIfExists('tcadscripciones');
    }
}
