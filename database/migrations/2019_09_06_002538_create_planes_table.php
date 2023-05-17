<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('descripcion');
            $table->decimal('capacidad', 4, 2);
            $table->decimal('precio', 4, 2);
            $table->string('imagen',200)->nullable();
            $table->timestamps();
        });
        DB::table('planes')->insert(array('id'=>'1', 'nombre'=>'Home Plus', 'descripcion' => 'Super bueno',
        'capacidad' => '4', 'precio' => '20.4', 'imagen' => 'foto'));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('planes');
    }
}
