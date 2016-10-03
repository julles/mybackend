<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Example extends Model
{
    public $guarded = [];

    public function rules()
    {
    	return [
    		'name'=>'required|max:225',
    		'email'=>'email|required',
    		'image'=>'image'
    	];
    }
}
