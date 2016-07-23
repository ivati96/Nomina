<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPermissions extends Model
{

    public function user_descripcion()
    {
        return $this->belongsTo(User::class);
    }

    public function menu_descripcion()
    {
        return $this->belongsTo(Menu::class);
    }

    protected $table = 'user_permissions';
}
