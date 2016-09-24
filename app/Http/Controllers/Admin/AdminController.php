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
    		$message = 'Data has been saved';
    	}else{
    		$model->create($inputs);
    		$message = 'Data has been updated';
    	}

    	
    	return redirect(Admin::urlBackendAction('index'))
    		->withSuccess($message);
    }
}
