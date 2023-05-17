<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturaProductoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factura_producto', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('producto_id')->nullable();
            $table->integer('plan_id')->nullable();
            $table->unsignedInteger('factura_id');
            $table->integer('cantidad');
            $table->decimal('descuento',4,2)->nullable();
            $table->decimal('precio',11,2);
            $table->text('descripcion')->nullable();
            $table->timestamps();
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');
            $table->foreign('factura_id')->references('id')->on('facturas')->onDelete('cascade');
        });
        DB::table('factura_producto')->insert(array('id'=>'1', 'producto_id'=>'1', 'plan_id'=>'1', 'factura_id' => '1',
        'descripcion' => 'Este es una union producto','cantidad'=>'4','descuento'=>'1','precio'=>'14'));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('factura_producto');
    }
}
