<?php

namespace App\Http\Controllers\Admin\User;

use Illuminate\Http\Request;
use Admin;
use App\Http\Requests;
use App\Http\Controllers\Admin\AdminController;
use Table;
use App\Models\Role;

class RoleController extends AdminController
{
	public function __construct(Role $model)
	{
        parent::__construct();
		$this->model = $model;
	}

    public function setForm()
    {
        $forms = [
            'role' => [
                'type'=>'text',
                'label'=>'Role',
                'properties'=>['class'=>'form-control']
            ],
        ];

        return $forms;
    }

    public function getData()
    {
        $fields = [
            'id',
            'role',
        ];

        $model = $this->model->select($fields);

        return Table::of($model)
        ->addColumn('action' ,function($model){
            if($model->id != 1)
            {
                return Admin::linkActions($model->id);
            }else{
                return '-';
            }    
        })
        ->make(true);
    }

    public function getIndex()
    {
        return view('admin.user.role.index');
    }

    public function getCreate()
    {
        return $this->form($this->model,$this->setForm());
    }

    public function postCreate(Requests\Admin\User\Role $request)
    {
    	return $this->insertOrUpdate($request->all(),$this->model);
    }

    public function getUpdate($id)
    {
        $model = $this->model->findOrFail($id);

        $this->exception($model);

        return $this->form($model,$this->setForm());
    }

    public function postUpdate(Requests\Admin\User\Role $request,$id)
    {
        $model = $this->model->findOrFail($id);

        $this->exception($model);

        return $this->insertOrUpdate($request->all(),$model);
    }

    public function getDelete($id)
    {
        $model = $this->model->findOrFail($id);

        $this->exception($model);

        return $this->delete($model);
    }

    public function exception($model)
    {
        if($model->id == 1)
        {
           throw new \Exception("Maaf Superadmin tidak bisa dihapus atau di update :) silahkan cek method exception()", 1);
             
        }
    }
}
