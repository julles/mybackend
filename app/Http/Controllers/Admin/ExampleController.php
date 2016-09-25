<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Admin\AdminController;

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
    			'value'=>'Muhamad Reza Abdul Rohim',
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

    public function getIndex()
    {
    	return $this->listing($this->model,['name','email','image']);
    }

    public function getCreate()
    {
    	return $this->form($this->model,$this->setForm());
    }

}
