<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Admin\AdminController;
use Admin;
use App\User;
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

    public function getForgot()
    {
        return view('admin.auth.forgot');
    }

    public function postForgot(Request $request)
    {
        $rules = [
            'email'=>'required|email',
        ];

        $this->validate($request,$rules);

        $cek = User::whereEmail($request->email)->first();

        if(empty($cek->id))
        {
            return redirect()->back()->withInfo('Email Not Found');
        }

        $newPassword = str_random(5).rand('1','9999');
        
        \Mail::send('admin.auth.emails.forgot' , ['newPassword' => $newPassword,'model' => $cek] , function($m) use ($cek){
                $m->from(Admin::noReply(), 'Reset Password');
                $m->subject('New Password');
                $m->to($cek->email);
            });

        $cek->update([
            'password' => \Hash::make($newPassword),
        ]);

        return redirect()->back()->withSuccess('the new password has been sent to your email');

    }
}
