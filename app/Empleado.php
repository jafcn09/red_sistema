<?php
namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $fillable = [
        'user_id','nombres','apellidos','cedula','telefono','celular','calle_p','calle_s','direccion','cargo','salario','descuento','total_salario','foto','foto_cedula','esta_activo',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'empleados';

    public function usuario(){
        return $this->belongsTo(User::class);
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
