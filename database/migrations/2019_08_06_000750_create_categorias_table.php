<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',50);
            $table->text('descripcion')->nullable();
            $table->unsignedInteger('esta_activo');

            $table->timestamps();
        });
        DB::table('categorias')->insert(array('id'=>'1','nombre'=>'Ventas', 'descripcion'=>'Las mejores ventas', 'esta_activo' => '1'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categorias');
    }
}
