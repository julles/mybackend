<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Admin\AdminController;
use Table;
use Admin;

use App\Models\Example;

class ExampleController extends AdminController
{
    public function __construct(Example $model)
    {
    	parent::__construct();
    	$this->model = $model;
    }

    public function setForm()
    {
    	$forms = [
    		'name'	=> [
    			'type'=>'text',
    			'label'=>'Name',
    			'properties'=>['class'=>'form-control'],
    			'value'=>null,
    		],
    		'email'	=> [
    			'type'=>'text',
    		],
    		'gender'	=> [
    			'type'=>'select',
    			'selects'=>[
    				'men'=>'Men',
    				'women'=>'Women',
    			],
    		],
    		'image'	=> [
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
            'id',
            'name',
            'email',
        ];

        $model = $this->model->select($fields);

        return Table::of($model)
        ->addColumn('action' ,function($model){
            return Admin::linkActions($model->id);
        })
        ->make(true);
    }

    public function getIndex()
    {
        return view('admin.example.index');
    }

    public function getCreate()
    {
    	return $this->form($this->model,$this->setForm());
    }

    public function postCreate(Request $request)
    {
        $this->validate($request,$this->model->rules());

        $inputs = $request->all();

        $inputs['image']=$this->handleUpload($request,$this->model,'image',[100,100]);

        return $this->insertOrUpdate($inputs,$this->model);
    }

    public function getUpdate($id)
    {
        return $this->form($this->model->findOrFail($id),$this->setForm());
    }

    public function postUpdate(Request $request,$id)
    {
        $model = $this->model->findOrFail($id);

        $this->validate($request,$this->model->rules());

        $inputs = $request->all();

        $inputs['image']=$this->handleUpload($request,$model,'image',[100,100]);

        return $this->insertOrUpdate($inputs,$model);
    }

    public function getDelete($id)
    {
        $model = $this->model->findOrFail($id);
        return $this->delete($model,[$model->image]);
    }
}
