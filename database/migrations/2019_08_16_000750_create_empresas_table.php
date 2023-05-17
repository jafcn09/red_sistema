<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',50);
            $table->string('ruc',50);
            $table->string('telefono',50);
            $table->string('celular',50);
            $table->string('direccion',50);
            $table->text('descripcion')->nullable();
            $table->binary('logo');
            $table->timestamps();
        });
        DB::table('empresas')->insert(array('id'=>'1','nombre'=>'REDSOTEC','ruc'=>'1712627213-001', 
        'telefono'=>'02-202 3793', 'celular' => '098-578 6064','direccion'=>'Pana norte KM 15, con calle tila maria Oe8-290',
        'descripcion'=>'Tenemos la mejor calidad en servicios','logo'=>'mi_logo.png'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresas');
    }
}
