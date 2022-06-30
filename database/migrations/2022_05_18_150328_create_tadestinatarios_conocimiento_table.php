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
            $table->integer('iid_otra_adscripcion')->unsigned()->nullable();
            $table->string('cdescrip_otra_adscrip')->nullable();
            $table->string('cnum_docto_seguim')->nullable();
            $table->string('cseguimiento',500)->nullable();
            $table->integer('iid_tipo_documento')->nullable();
            $table->integer('iid_estatus_documento')->nullable();
            $table->date('dfecha_seguimiento')->nullable();
            $table->string('cruta_archivo_seguim')->nullable();
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
