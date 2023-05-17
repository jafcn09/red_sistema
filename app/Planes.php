<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Planes extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre','descripcion','capacidad','precio','imagen',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'planes';

    //Acceso desde contratos
    public function contratos()
    {
        return $this->hasMany('App\Contrato');

    }

}
