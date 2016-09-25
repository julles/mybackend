<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Admin;

class AdminController extends Controller
{
    public function __construct()
    {
		    	
    }

    public function insertOrUpdate($inputs , $model)
    {
    	if(!empty($model->id))
    	{
    		$model->update($inputs);
    		$message = 'Data has been updated';
    	}else{
    		$model->create($inputs);
    		$message = 'Data has been saved';
    	}

    	
    	return redirect(Admin::urlBackendAction('index'))
    		->withSuccess($message);
    }

    public function delete($model)
    {
    	try
    	{
    		$model->delete();
    		return redirect(Admin::urlBackendAction('index'))
    		->withSuccess("Data has been deleted");
    	}catch(\Exception $e){
    		return redirect(Admin::urlBackendAction('index'))
    		->withSuccess("Data has cannot be deleted");
    	}
    }

    public function setModelListing($model,$fields=[],$properties=[])
    {
    	$lists = $model;

    	foreach($fields as $row)
    	{
	        if(!empty(request()->get($row)))
	        {
	            $lists = $lists->where($row,'like','%'.request()->get($row).'%');
	        }

    	}

    	if(!empty($properties['paginate']))
    	{
    		$paging = $properties['paginate'];
    	}else{
    		$paging = 5;
        }
    	
		$lists = $lists->paginate($paging);
    	
    	return $lists;
    }

    public function listing($model,$fields=[],$properties=[])
    {
    	$lists= $this->setModelListing($model,$fields,$properties);
    	return view('admin.scaffolding.listing' ,[
            'lists'=>$lists,
            'fields'=>$fields,
        ]);
    }

    public function form($model,$setForm)
    {
        $model = $model;

        $forms = $setForm;

        return view('admin.scaffolding.form' , [
            'model'=>$model,
            'forms'=>$forms,
        ]);
    }
}
