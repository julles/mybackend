<?php
/**
 * Admin Routes here
 */
Route::group(['middlewareGroups'=>['web']] , function(){
	Route::controller('login','Admin\LoginController');
});

Route::group(['middleware'=>['web','auth'] ,'prefix'=> \Admin::backendUrl()] , function(){

	foreach(\Site::parentIsNotNull() as $row)
	{
		if(Site::controllerExists($row) == true)
		{
			Route::controller($row->slug,$row->controller);
		}else{
			Route::get($row->slug.'/index' , function(){
				throw new \Exception("Controller tidak ditemukan mas :) , cek method controllerExists() di class Site.", 1);
			});
		}
	}

		Route::controller('role','Admin\User\RoleController');
		Route::controller('example','Admin\ExampleController');

});