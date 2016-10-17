<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\MenuAction;
use App\Models\Role;

class Right extends Model
{
    public $guarded = [];

    public function menu_action()
    {
    	return $this->belongsTo(MenuAction::class,'menu_action_id');
    }

    public function role()
    {
    	return $this->belongsTo(Role::class,'role_id');
    }
}
