<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $dates = ['updated_at'];
    protected $guarded = [];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'categoria_id','codigo','nombre','marca','modelo','descripcion','cantidad','precio',
        'condicion','asignado','imagen',
    ];
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

}
