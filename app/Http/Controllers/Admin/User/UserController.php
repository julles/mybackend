<?php

namespace App\Http\Controllers\Admin\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Admin\AdminController;
use Table;
use Admin;

use App\User;

class UserController extends AdminController
{
    public function __construct(User $model)
    {
    	parent::__construct();
    	$this->model = $model;
    }

    public function roles()
    {
    	$model = Admin::inject('Role');

    	return $model->lists('role','id')->toArray();
    }

    public function setForm()
    {
    	$forms = [
    		'role_id'	=> [
    			'type'=>'select',
    			'selects'=>[''=>'Select Role']+$this->roles(),
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

    public function getData()
    {
        $fields = [
            'users.id',
            'name',
            'email',
            'role',
        ];

        $model = $this->model->select($fields)
        ->join('roles','roles.id','=','users.role_id')
        ->where('users.id','!=',1);

        return Table::of($model)
        ->addColumn('action' ,function($model){
            return Admin::linkActions($model->id);
        })
        ->make(true);
    }
    
    public function getIndex()
    {
        return view('admin.user.user.index');
    }

    public function getCreate()
    {
    	return $this->form($this->model,$this->setForm());
    }

    public function postCreate(Request $request)
    {
    	$model = $this->model;

    	$this->validate($request,$model->rules());

    	$inputs = $request->all();

    	$inputs['avatar']=$this->handleUpload($request,$model,'avatar',[160,160]);
	   
        $inputs['password']=\Hash::make($request->password);

    	return $this->insertOrUpdate($inputs,$model);
	}

	public function getUpdate($id)
    {
    	$model = $this->model->findOrFail($id);
    	return $this->form($model,$this->setForm());
    }

    public function postUpdate(Request $request,$id)
    {
        if($id == 1)
        {
            return redirect()->back()->withInfo('Super Admin Cannot be updated');
        }

    	$model = $this->model->findOrFail($id);

    	$this->validate($request,$model->rules($id));

    	$inputs = $request->all();

    	$inputs['avatar']=$this->handleUpload($request,$model,'avatar',[160,160]);
	   
        $inputs['password']=\Hash::make($request->password);

    	return $this->insertOrUpdate($inputs,$model);
	}

	public function getDelete($id)
    {
        if($id == 1)
        {
            return redirect()->back()->withInfo('Super Admin Cannot be deleted');
        }

        $model = $this->model->findOrFail($id);
        return $this->delete($model,[$model->avatar]);
    }

    public function isSuperAdmin($id)
    {
        if($id == 1)
        {
            return redirect()->back()->withInfo('Super Admin Cannot be deleted');
        }
    }
}
