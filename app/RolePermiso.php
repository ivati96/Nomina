<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RolePermiso extends Model
{
    public function role_descripcion()
    {
        return $this->belongsTo(Role::class);
    }

    public function menu_descripcion()
    {
        return $this->belongsTo(Menu::class);
    }

    protected $table = 'role_permisos';
}
