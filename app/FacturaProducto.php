<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacturaProducto extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'producto_id','plan_id','factura_id','descuento','cantidad','precio',
    ];
    public $timestamps = false;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'factura_producto';

    //Funciones
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function factura()
    {
        return $this->belongsTo(Factura::class);
    }

}
