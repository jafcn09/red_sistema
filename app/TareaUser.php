<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TareaUser extends Model
{
    protected $dates = ['updated_at'];
    protected $guarded = [];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','tarea_id',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tarea_user';
    //Relacion con clientes
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //Relacion con nodos
    public function tarea()
    {
        return $this->belongsTo(Tarea::class);
    }
    //Obtener atributos por nombre
    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

}
