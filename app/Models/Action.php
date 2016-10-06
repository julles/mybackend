<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    protected $fillable = ['code','action'];

    public function rules($id="")
    {
    	return [
    		'code'=>'required|max:10|unique:actions,id,'.$id,
    		'action'=>'required|max:20',
    	];
    }
}
