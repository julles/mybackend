<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Admin\AdminController;
use Admin;
class LoginController extends AdminController
{
    public function getIndex()
    {
    	return view('admin.auth.login');
    }

    public function postIndex(Request $request)
    {
    	$rules = [
    		'email'=>'required|email',
    		'password'=>'required',
    	];

    	$this->validate($request,$rules);

    	$credentials = [
    		'email'=>$request->email,
    		'password'=>$request->password,
    	];

    	if(auth()->attempt($credentials))
    	{
    		return redirect(Admin::urlDefaultPage());
    	}else{
    		return redirect()->back()->withInfo('Data not Found!');
    	}
    }

    public function getSignOut()
    {
        \Auth::logout();
    
        return redirect('login');
    }
}
