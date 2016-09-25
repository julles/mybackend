<?php

namespace App\Http\Controllers\Admin\User;

use Illuminate\Http\Request;
use Admin;
use App\Http\Requests;
use App\Http\Controllers\Admin\AdminController;

use App\Models\Role;

class RoleController extends AdminController
{
	public function __construct(Role $model)
	{
        parent::__construct();
		$this->view = 'admin.user.role.';
		$this->model = $model;
	}

    public function getIndex()
    {
        $model = $this->model->where('id','!=','1');
        
        return $lists = $this->listing($model,['role']);
    }

    public function getCreate()
    {
        return view($this->view.'form' , [
    		'model'=>$this->model,
    	]);
    }

    public function postCreate(Requests\Admin\User\Role $request)
    {
    	return $this->insertOrUpdate($request->all(),$this->model);
    }

    public function getUpdate($id)
    {
        return view($this->view.'form' , [
            'model'=>$this->model->findOrFail($id),
        ]);
    }

    public function postUpdate(Requests\Admin\User\Role $request,$id)
    {
        return $this->insertOrUpdate($request->all(),$this->model->findOrFail($id));
    }

    public function getDelete($id)
    {
        $model = $this->model->findOrFail($id);

        return $this->delete($model);
    }
}
