<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enlace extends Model
{
    protected $dates = ['updated_at'];
    protected $guarded = [];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','producto_id','router_id','nodo_id','ip','mac','coordenadas','activo','imagen',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'enlaces';
    //Relacion con clientes
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //Relacion con nodos
    public function nodo()
    {
        return $this->belongsTo(Nodo::class);
    }
    //Relacion con productos
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

}
