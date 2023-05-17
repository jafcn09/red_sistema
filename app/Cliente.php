<?php

namespace App;
use App\FacturaContrato;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'user_id','nombres','apellidos','cedula','telefono','celular','calle_p','calle_s','direccion','foto','foto_cedula','es_vip','esta_activo',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'clientes';

    //Relacion con facturas
    public function factura()
    {
        return $this->belongToMany(Factura::class);
    }
    public function usuario(){
        return $this->belongsTo(User::class);
    }
    //Relacion con enlaces
    public function enlaces(){
        return $this->belongsToMany(Enlace::class);
    }
    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    //Casting
    protected $casts = [
        'es_vip' => 'boolean',
        'esta_activo' => 'boolean',
    ];

    
}
