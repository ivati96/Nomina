<?php

namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Role;
use App\CatalogoEstado;
class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name', 'email', 'password', 'last_name','user', 'role', 'estado_id', 'estados', 'roles'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function estados()
    {
        return $this->belongsTo(CatalogoEstado::class, 'estado_id');
    }

    public function roles()
    {
        return $this->belongsTo(Role::class, 'role');
    }
}
