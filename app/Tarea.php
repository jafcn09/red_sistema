<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    //
    protected $fillable = [
        'tipo_tarea', 'nombre_tarea','description','solucion','cliente_id','user_id','asignado_a','fecha_solucion','estatus','esta_activo'
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tareas';
    //Relacion con contratos
    public function users(){
        return $this->belongsToMany(User::class);   
    }
    //Obtener atributos por nombre
    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }
}
