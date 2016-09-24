<?php
Route::group(['middleware'=>['web'] ,'prefix'=> \Admin::backendUrl()] , function(){

	Route::get('/', function () {
		return view('admin.example.index');
	});

	Route::controller('role','Admin\User\RoleController');

});
