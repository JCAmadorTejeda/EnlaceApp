<?php

namespace App;

use App\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $primaryKey = 'id_employee';
    public $incrementing = false;
    const USUARIO_ADMINISTRADOR = 'true';
    const USUARIO_NO_ADMINISTRADOR = 'false';
    const EMPLEADO_ACTIVO = '1';
    const EMPLEADO_INACTIVO = '0';

    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_key',
    ];

    /**
     * @var array
     */
    protected $fillable = ['id_employee','password', 'api_key', 'admin', 'status'];


    public function isAdmin(){
        return $this->admin == User::USUARIO_ADMINISTRADOR;
    }

    public static function generartoken(){
        return str_random(40);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function requests()
    {
        return $this->hasMany(Request::class, 'id_employee', 'id_employee');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id_employee', 'id_employee');
    }

    public function isActive()
    {
        return $this->status == User::EMPLEADO_ACTIVO;
    }
}
