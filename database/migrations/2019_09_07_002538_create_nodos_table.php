<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nodos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('descripcion');
            $table->unsignedInteger('torre_id');
            $table->unsignedInteger('producto_id');
            $table->string('ip');
            $table->string('mac');
            $table->enum('activo',['SI','NO']);
            $table->string('imagen',200)->nullable();
            $table->timestamps();

            $table->foreign('producto_id')->references('id')->on('productos');
            $table->foreign('torre_id')->references('id')->on('torres')->onDelete('cascade');
        });
        DB::table('nodos')->insert(array('id'=>'1', 'torre_id'=>'1','nombre'=>'PANA NORTE', 'descripcion'=>'ENLACE DE 10 MEGAS PUROS',
        'producto_id' => '1', 'ip' => '192.168.100.22', 'mac' => '22:54:t6:4r:7u',
        'activo' => 'SI', 'imagen' => 'foto/enlace.png'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nodos');
    }
}
