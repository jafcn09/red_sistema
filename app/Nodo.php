<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nodo extends Model
{
    protected $dates = ['updated_at'];
    protected $guarded = [];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre','descripcion','torre_id','ubicacion','producto_id','ip','mac','activo','imagen',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'nodos';
    //Relacion con enlaces
    public function enlaces()
    {
       return $this->belongsToMany(Enlace::class);
    }
    //Relacion con productos
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
    //Relacion con torres
    public function torre()
    {
        return $this->belongsTo(Torre::class);
    }
}
