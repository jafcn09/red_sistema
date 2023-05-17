<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('cliente_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('empresa_id');
            $table->integer('factura_num');
            $table->enum('tipo_comprobante',['FACTURA','RECIBO']);
            $table->dateTime('fecha_hora');
            $table->decimal('impuesto', 4, 2);
            $table->decimal('total', 11, 2);
            $table->enum('esta_paga',['SI','NO']);
            $table->text('nota')->nullable();
            $table->timestamps();
            $table->foreign('cliente_id')->references('id')->on('users');
            $table->foreign('empresa_id')->references('id')->on('empresas');
        });
        DB::table('facturas')->insert(array('id'=>'1', 'cliente_id'=>'3', 'user_id' => '1','empresa_id'=>'1',
        'factura_num'=>'11', 'fecha_hora'=>'2019-09-10 00:26:29', 'impuesto' => '12','total' => '200',
        'esta_paga' => 'SI','nota' => 'Esta es una nota'));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facturas');
    }
}
