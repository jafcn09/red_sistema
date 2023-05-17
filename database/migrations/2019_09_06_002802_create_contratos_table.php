<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('plan_id');
            $table->unsignedInteger('user_id');
            $table->string('contrato_num')->unique();
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable();
            $table->text('descripcion')->nullable();
            $table->timestamps();
            $table->foreign('plan_id')->references('id')->on('planes')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        DB::table('contratos')->insert(array('id'=>'1', 'plan_id' => '1','user_id' => '3','contrato_num'=>'REDSOTEC-01', 'fecha_inicio'=>'2018-09-07 21:44:29', 
        'fecha_fin' => '2019-09-07 21:44:29', 'descripcion' => 'Contrato a tiempo determinado'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contratos');
    }
}
