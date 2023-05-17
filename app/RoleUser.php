<?php

namespace App;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $dates = ['updated_at'];
    protected $guarded = [];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id','user_id',
    ];
    public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'role_user';
    //Funciones
    public function users()
    {
        return $this->belongsTo(User::class);
    }
    //Funciones
    public function roles()
    {
        return $this->belongsTo('\Caffeinated\Shinobi\Models\Role')->withTimestamps();
    }
}
