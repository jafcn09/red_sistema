<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre','descripcion','esta_activo',
    ];
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
