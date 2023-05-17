<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    protected $dates = ['updated_at'];
    protected $guarded = [];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombres','apellidos','celular','email', 'titulo_mensaje','mensaje','producto_id','servicio_id',
        'plan_id','es_suscripcion','es_contacto', 'es_producto','es_servicio','es_internet','es_ayuda'
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contacto';
    //Obtener atributos por nombre
    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

}
