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
        Schema::dropIfExists('tapersonal_conocimiento');
    }
}
