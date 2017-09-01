<?php
/**
 * Admin Routes here
 */
Route::group(['middlewareGroups'=>['web']] , function(){
	Route::controller('login','Admin\LoginController');
	Route::get( \Admin::backendUrl(),function(){
		return redirect('login');
	});
});

Route::group(['middleware'=>['auth','admin'] ,'prefix'=> \Admin::backendUrl()] , function(){

	if(\Schema::hasTable('menus'))
	{
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

		Route::get('my-profile/index','Admin\MyProfileController@getMyProfile');

		Route::get('grab-data','Admin\AdminController@datatablesdata');

		Route::get('delete-image/{image}/{token}','Admin\DeleteImageController@delete');
	}
});
