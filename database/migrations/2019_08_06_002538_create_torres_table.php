<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTorresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('torres', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_torre');
            $table->string('descripcion_torre');
            $table->string('calle_p');
            $table->string('calle_s');
            $table->string('direccion');
            $table->string('coordenadas');
            $table->enum('activo',['SI','NO']);
            $table->string('imagen',200)->nullable();
            $table->timestamps();
        });
        DB::table('torres')->insert(array('id'=>'1', 'nombre_torre'=>'PANA NORTE', 'descripcion_torre' => 'TORRE PRINCIPAL', 
        'calle_p' => 'PANA NORTE', 'calle_S' => 'TILA MARIA','direccion' => 'OE9-290', 'coordenadas' => 'NORTE Y SUR','activo' => 'SI',
        'imagen' => 'foto/enlace.png'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('torres');
    }
}
