<?php

namespace App;

use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
//use Caffeinated\Shinobi\Traits\Permission\HasRoles;
//use Caffeinated\Shinobi\Concerns\HasRolesAndPermissions;

class User extends Authenticatable
{
    use Notifiable, ShinobiTrait;
    //use HasRoles;
    //use HasRolesAndPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cedula','nombres','apellidos','telefono','celular','email', 'password','calle_p','calle_s',
        'direccion','salario', 'descuento','total_salario','foto','foto_cedula','es_vip','esta_activo',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    //Relacion con clientes
    public function clientes(){
        return $this->belongsToMany(Cliente::class);
    }
        //Relacion con facturas
        public function factura()
        {
            return $this->belongToMany(Factura::class);
        }
        //Relacion con enlaces
        public function enlaces(){
            return $this->belongsToMany(Enlace::class);
        }
        //Relacion con enlaces
        public function roles(){
            return $this->belongsToMany('\Caffeinated\Shinobi\Models\Role');
        }
        //Relacion con contratos
        public function contratos(){
            return $this->belongsToMany(Contrato::class);
        }
        public function getNameAttribute($value)
        {
            return ucfirst($value);
        }
        //Relacion con tareas
        public function tareas(){
            return $this->belongsToMany(Tarea::class);
        }
        //Relacion con mensajes
        public function messages(){
            return $this->belongsToMany(Message::class);
        }
}
