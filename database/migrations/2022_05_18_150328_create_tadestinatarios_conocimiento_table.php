<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTadestinatariosConocimientoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tadestinatarios_conocimiento', function (Blueprint $table) {
            $table->increments('iid_destinatario_conocimiento');
            $table->integer('iid_documento')->unsigned()->nullable();
            $table->integer('iid_adscripcion')->unsigned()->nullable();
            $table->string('seguimiento')->nullable();
            $table->date('fecha_seguimiento')->nullable();
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
        Schema::dropIfExists('tadestinatarios_conocimiento');
    }
}
