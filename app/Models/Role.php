<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
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
}
