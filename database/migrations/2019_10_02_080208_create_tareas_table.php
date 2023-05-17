<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tareas', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('tipo_tarea', ['FALLA', 'RECLAMO', 'SOLICITUD'])->nullable();
            $table->string('nombre_tarea');
            $table->text('description')->nullable();
            $table->text('solucion')->nullable();
            $table->unsignedInteger('cliente_id')->nullable();
            $table->unsignedInteger('user_id');
            $table->integer('asignado_a');
            $table->date('fecha_solucion');
            $table->enum('estatus', ['ASIGNADA', 'EN-PROCESO','COMPLETADA'])->nullable();
            $table->enum('esta_activo', ['SI', 'NO']);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migration.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tareas');
    }
}
