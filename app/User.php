<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Role;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role_id','avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class,'role_id');
    }

    public function rules($id="")
    {
        return [
            'name'=>'required|max:100',
            'email'=>'required|email|unique:users,email,'.$id,
            'password'=>'required',
            'verify_password'=>'same:password',
            'avatar'=>'image',
        ];
    }
}
