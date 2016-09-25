<?php
Route::group(['middlewareGroups'=>['web'] ,'prefix'=> \Admin::backendUrl()] , function(){

	Route::controller('role','Admin\User\RoleController');
	Route::controller('example','Admin\ExampleController');

	Route::get('/', function () {
		return view('admin.example.index');
	});
	
});
