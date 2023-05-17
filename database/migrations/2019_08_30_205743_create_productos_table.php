<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('categoria_id');
            $table->string('codigo');
            $table->string('nombre');
            $table->string('descripcion');
            $table->string('marca')->nullable();
            $table->string('modelo')->nullable();
            $table->integer('cantidad');
            $table->decimal('precio',11,2);
            $table->boolean('condicion')->default(1);
            $table->boolean('asignado')->default(0);
            $table->string('imagen',200)->nullable();
            $table->timestamps();

            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');
        });
        DB::table('productos')->insert(array('id'=>'1','categoria_id'=>'1', 'codigo'=>'1212121212',
        'nombre'=>'Router','descripcion' => 'router 300 mb','marca'=>'Hawei','modelo' => 'MMM-500','cantidad'=>'12','precio'=>'25',
        'condicion'=>'1','asignado'=>'1','imagen' => 'foto'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
