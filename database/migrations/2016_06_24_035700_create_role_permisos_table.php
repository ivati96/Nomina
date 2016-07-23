<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolePermisosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_permisos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role')->unsigned();
            $table->foreign('role')->references('id')->on('roles');
            $table->integer('menu')->unsigned();
            $table->foreign('menu')->references('id')->on('menus');
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
        Schema::drop('role_permisos');
    }
}
