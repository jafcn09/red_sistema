<?php

namespace App;
use App\FacturaContrato;
use App\Plane;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    protected $dates = ['updated_at'];
    protected $guarded = [];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'plan_id', 'user_id', 'contrato_num', 'fecha_inicio','fecha_fin','descripcion',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contratos';

    /**
     * Contratos can belong to many users.
     *
     * @return Model
     */
    public function facturas()
    {
        return $this->hasOne('App\Cliente');
    }

    public function planes()
    {
        return $this->belongsTo('App\Planes', 'contrato_num', 'nombre');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
