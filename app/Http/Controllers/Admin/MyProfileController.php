<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Admin\AdminController;
use App\User;
use Admin;

class MyProfileController extends AdminController
{
	public function __construct()
	{
	   parent::__construct();
       $this->model = User::findOrFail(user()->id);
       $this->validation = 'App\Http\Requests\Admin\User\UserRequest';
    }

	public function setForm()
    {
    	$forms = [
    		'role'	=> [
    			'type'=>'text',
    			'properties'=>['readonly'=>true,'class'=>'form-control'],
                'value'=>user()->role->role,
                'label'=>'Role',
    		],
    		'name'=> [
    			'type'=>'text',
    		],
    		'email'=> [
    			'type'=>'text',
    		],
    		'password'=> [
    			'type'=>'password',
    		],
    		'verify_password'=> [
    			'type'=>'password',
    			'label'=>'Verify Password',
    		],
    		'avatar' => [
    			'type'=>'file',
    			'properties'=>[
    				'class'=>null,
    			],
    		],
    	];

    	return $forms;
    }

    public function getIndex()
    {
    	$model = $this->model;

    	return $this->form($model,$this->setForm());
    }

    public function postIndex(Requests\Admin\User\UserRequest $request)
    {
        $model = $this->model;

        $id = $model->id;

        $request->role_id = $model->role_id;
        
        $inputs = $request->all();

        $inputs['avatar']=$this->handleUpload($request,$model,'avatar',[160,160]);
       
        $inputs['password']=\Hash::make($request->password);

        return $this->insertOrUpdate($inputs,$model);
    }
}
