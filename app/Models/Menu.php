<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Action;
use App\Models\MenuAction;
class Menu extends Model
{
	public $guarded = [];

    public function parent()
    {
    	return $this->belongsTo(Menu::class,'parent_id');
    }

    public function childs()
    {
    	return $this->hasMany(Menu::class,'parent_id');
    }

    public function actions()
    {
    	return $this->belongsToMany(Action::class,'menu_actions');
    }

    public function menuAction()
    {
        return $this->hasMany(MenuAction::class,'menu_id');
    }
}
