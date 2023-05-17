<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            //Acceso usuarios
            $table->increments('id');
            $table->bigInteger('cedula')->unique();
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('telefono')->nullable();
            $table->string('celular')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            //Acceso clientes
            $table->string('calle_p',50)->nullable();
            $table->string('calle_s',50)->nullable();
            $table->text('direccion')->nullable();
            $table->decimal('salario',10,2)->nullable();
            $table->decimal('descuento',10,2)->nullable();
            $table->decimal('total_salario',10,2)->nullable();
            $table->string('foto',200)->nullable();
            $table->string('foto_cedula',200)->nullable();
            $table->tinyInteger('es_vip')->default('0');
            $table->tinyInteger('esta_activo')->default('1');

            
            $table->timestamps();
        });
        DB::table('users')->insert(array('id'=>'1','cedula'=>'123456789','nombres'=>'Franklin Santiago','apellidos' => 'Martinez Soto',
        'telefono' => '020202022','celular' => '04140404433','email'=>'franklinsmartinez@gmail.com','password' => '$2y$10$LuxarzyIsOmx7GcRnnLQYeq8/7Oz9aSsqsSiLUeoJsNLVV3n7RvYa',
        'calle_p' => 'los cocos','calle_s' => 'venezuela','direccion' => 'calle tila la marca',
        'salario' => '0','descuento' => '0','total_salario' => '0','foto' => 'mi_foto',
        'foto_cedula' => 'mi_cedula','es_vip' => '0','esta_activo' => '1',
        'created_at' => '2020-07-10 00:00:00.000000', 'updated_at' => '2020-07-10 00:00:00.000000'));
        DB::table('users')->insert(array('id'=>'2','cedula'=>'8888888','nombres'=>'Elis Nataly','apellidos' => 'Torres Ñañez',
        'telefono' => '022009988','celular' => '0994704566','email'=>'etorres@gmail.com','password' => '$2y$10$LuxarzyIsOmx7GcRnnLQYeq8/7Oz9aSsqsSiLUeoJsNLVV3n7RvYa',
        'calle_p' => 'pichincha','calle_s' => 'quito','direccion' => 'calle tila maria',
        'salario' => '430.20','descuento' => '12.50','total_salario' => '460.50','foto' => 'mi_foto',
        'foto_cedula' => 'mi_cedula','es_vip' => '1','esta_activo' => '1',
        'created_at' => '2019-09-10 00:00:00.000000', 'updated_at' => '2019-09-10 00:00:00.000000'));
	    DB::table('users')->insert(array('id'=>'3','cedula'=>'1234567','nombres'=>'Pedro Felix','apellidos' => 'Urbaneja Marquez',
        'telefono' => '022089933','celular' => '0969980098','email'=>'pfelix@gmail.com','password' => '$2y$10$LuxarzyIsOmx7GcRnnLQYeq8/7Oz9aSsqsSiLUeoJsNLVV3n7RvYa',
        'calle_p' => 'pichincha','calle_s' => 'quito','direccion' => 'calle tila maria',
        'salario' => '0','descuento' => '0','total_salario' => '0','foto' => 'mi_foto',
        'foto_cedula' => 'mi_cedula','es_vip' => '0','esta_activo' => '1',
        'created_at' => '2019-09-10 00:00:00.000000', 'updated_at' => '2019-09-10 00:00:00.000000'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
