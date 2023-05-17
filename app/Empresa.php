<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $dates = ['updated_at'];
    protected $guarded = [];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre','ruc','telefono','celular','direccion','descripcion','logo'
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'empresas';

}
