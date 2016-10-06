<?php

namespace App\Http\Controllers\Admin\Development;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Admin\AdminController;
use Table;
use Admin;

use App\Models\Action;

class ActionController extends AdminController
{
	public function __construct(Action $model)
	{
		parent::__construct();
		$this->model = $model;
		$this->view = 'admin.development.action.';
	}

	public function setForm()
	{
		return [
			'code'=>[
				'type'=>'text',
				'label'=>'Code',
				'properties'=>['class'=>'form-control'],
    			'value'=>null,
			],
			'action'=>[
				'type'=>'text',
				'label'=>'Action',
				'properties'=>['class'=>'form-control'],
    			'value'=>null,
			],
		];
	}

	public function getData()
	{
		$selects = ['id','code','action'];
		$model = $this->model->select($selects);
		$table = Table::of($model)
			->addColumn('actions',function($model){
				return Admin::linkActions($model->id);
			})
			->make(true);
		return $table;
	}

    public function getIndex()
    {
    	return view($this->view.'index');
    }

    public function getCreate()
    {
    	return $this->form($this->model,$this->setForm());
    }

    public function postCreate(Request $request)
    {
        $this->validate($request,$this->model->rules());

        $inputs = $request->all();

        return $this->insertOrUpdate($inputs,$this->model);
    }

    public function getUpdate($id)
    {
    	return $this->form($this->model->findOrFail($id),$this->setForm());
    }

    public function postUpdate(Request $request,$id)
    {
        $this->validate($request,$this->model->rules($id));

        $inputs = $request->all();

        return $this->insertOrUpdate($inputs,$this->model->findOrFail($id));
    }

    public function getDelete($id)
    {
        $model = $this->model->findOrFail($id);
        return $this->delete($model,[$model->image]);
    }
}
