<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacto', function (Blueprint $table) {
            //Acceso usuarios
            $table->increments('id');
            $table->string('nombres')->nullable();
            $table->string('apellidos')->nullable();
            $table->string('celular')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('titulo_mensaje')->nullable();
            $table->text('mensaje')->nullable();
            $table->integer('producto_id')->nullable();
            $table->integer('servicio_id')->nullable();
            $table->integer('plan_id')->nullable();
            $table->rememberToken();
            $table->tinyInteger('es_suscripcion')->default('0');
            $table->tinyInteger('es_contacto')->default('0');
            $table->tinyInteger('es_producto')->default('0');
            $table->tinyInteger('es_servicio')->default('0');
            $table->tinyInteger('es_internet')->default('0');
            $table->tinyInteger('es_ayuda')->default('0');
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
        Schema::dropIfExists('contacto');
    }
}
