<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Torre extends Model
{
    protected $dates = ['updated_at'];
    protected $guarded = [];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre_torre','descripcion_torre','calle_p','calle_s','direccion','coordenadas','activo','imagen',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'torres';
    //Relacion con nodos
    public function nodos()
    {
       return $this->belongsToMany(Nodo::class);
    }

}
