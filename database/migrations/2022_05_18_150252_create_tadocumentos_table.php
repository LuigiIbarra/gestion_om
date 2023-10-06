<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTadocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tadocumentos', function (Blueprint $table) {
            $table->increments('iid_documento');
            $table->string('cfolio')->nullable();
            $table->date('dfecha_recepcion')->nullable();
            $table->string('cnumero_documento',100)->nullable();
            $table->date('dfecha_documento')->nullable();
            $table->integer('iid_tipo_documento')->unsigned()->nullable();
            $table->integer('iid_tipo_anexo')->unsigned()->nullable();
            $table->integer('iid_personal_remitente')->unsigned()->nullable();
            $table->integer('iid_estatus_documento')->unsigned()->nullable();
            $table->integer('iid_prioridad_documento')->unsigned()->nullable();
            $table->integer('iid_semaforo')->unsigned()->nullable();
            $table->string('cnomenclatura_archivistica',100)->nullable();
            $table->integer('iid_importancia_contenido')->nullable();
            $table->integer('iid_tema')->unsigned()->nullable();
            $table->integer('iid_tipo_asunto')->unsigned()->nullable();
            $table->integer('iid_instruccion')->unsigned()->nullable();
            $table->date('dfecha_termino')->nullable();
            $table->string('casunto',500)->nullable();
            $table->string('cobservaciones',500)->nullable();
            $table->string('cruta_archivo_documento',250)->nullable();
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
        Schema::dropIfExists('tadocumentos');
    }
}
