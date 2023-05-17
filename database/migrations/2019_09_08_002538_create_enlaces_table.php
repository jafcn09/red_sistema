<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enlaces', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('producto_id');
            $table->integer('router_id');
            $table->unsignedInteger('nodo_id');
            $table->string('ip');
            $table->string('mac');
            $table->string('coordenadas')->nullable();
            $table->enum('activo',['SI','NO']);
            $table->string('imagen',200)->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('producto_id')->references('id')->on('productos');
            $table->foreign('nodo_id')->references('id')->on('nodos')->onDelete('cascade');
        });
        DB::table('enlaces')->insert(array('id'=>'1', 'user_id'=>'3', 'producto_id' => '1',
        'router_id' => '1','nodo_id' => '1', 'ip' => '192.168.100.22', 'mac' => '22:54:t6:4r:7u',
        'coordenadas' => 'N.33.33,O.21.44.01','activo' => 'SI', 'imagen' => 'foto/enlace.png'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enlaces');
    }
}
