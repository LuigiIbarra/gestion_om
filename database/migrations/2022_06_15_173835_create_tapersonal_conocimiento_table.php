<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTapersonalConocimientoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tapersonal_conocimiento', function (Blueprint $table) {
            $table->increments('iid_personal_conocimiento');
            $table->integer('iid_documento')->nullable();
            $table->integer('iid_personal')->nullable();
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
        Schema::dropIfExists('tapersonal_conocimiento');
    }
}
