<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DeleteImageController extends Controller
{
    public function delete($img,$token)
    {
		if($token == \Admin::generateToken(auth()->user()->id))
    	{
    		$cek = public_path('contents/'.$img);
    		if(file_exists($cek))
	    	{
	    		@unlink($cek);
	    	}
	    	return redirect()->back();
    	}else{
    		abort(404);
    	}
	}
}
