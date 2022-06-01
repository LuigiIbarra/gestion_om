<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTcrolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tcroles', function (Blueprint $table) {
            $table->increments('iid_rol');
            $table->string('cnombre_rol',20)->nullable();
            $table->string('cdescripcion_rol',20)->nullable();
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
        Schema::dropIfExists('tcroles');
    }
}
