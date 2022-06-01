<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTcpermisosRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tcpermisos_roles', function (Blueprint $table) {
            $table->increments('iid_permiso_rol');
            $table->integer('iid_rol')->unsigned()->nullable();
            $table->integer('iid_permiso')->unsigned()->nullable();
            $table->integer('ipermiso')->unsigned()->nullable();
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
        Schema::dropIfExists('tcpermisos_roles');
    }
}
