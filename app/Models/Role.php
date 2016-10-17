<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

use App\Models\MenuAction;
use App\Models\Right;

class Role extends Model
{

	use Sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'code' => [
                'source' => 'role'
            ]
        ];
    }

    protected $fillable = ['code','role'];

    public function menu_actions()
    {
        return $this->belongsToMany(MenuAction::class,'rights');
    }

    public function rights()
    {
        return $this->hasMany(Right::class,'role_id');
    }
}
