<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTadestinatariosAtencionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tadestinatarios_atencion', function (Blueprint $table) {
            $table->increments('iid_destinatario_atencion');
            $table->integer('iid_documento')->unsigned()->nullable();
            $table->integer('iid_adscripcion')->unsigned()->nullable();
            $table->integer('iid_otro_personal')->unsigned()->nullable();
            $table->integer('iid_otro_puesto')->unsigned()->nullable();
            $table->integer('iid_otra_adscripcion')->unsigned()->nullable();
            $table->string('cnum_docto_resp')->nullable();
            $table->integer('iid_tipo_documento')->nullable();
            $table->integer('iid_estatus_documento')->nullable();
            $table->string('crespuesta',500)->nullable();
            $table->date('dfecha_concluido')->nullable();
            $table->string('cruta_archivo_respuesta')->nullable();
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
        Schema::dropIfExists('tadestinatarios_atencion');
    }
}
