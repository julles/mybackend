<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Menu;
use App\Models\Action;

class MenuAction extends Model
{
	protected $fillable = ['menu_id','action_id'];

    public function menu()
    {
    	return $this->belongsTo(Menu::class,'menu_id');
    }

    public function action()
    {
    	return $this->belongsTo(Action::class,'action_id');
    }
}
