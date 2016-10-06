<?php
/**
 * Admin Routes here
 */
Route::group(['middlewareGroups'=>['web'] ,'prefix'=> \Admin::backendUrl()] , function(){

	foreach(\Site::parentIdNotNull() as $row)
	{
		if(Site::controllerExists($row) == true)
		{
			Route::controller($row->slug,$row->controller);
		}else{
			Route::get($row->slug.'/index' , function(){
				echo '<h1>Controller Kaga ada mas :)</h1>';
			});
		}
	}

		Route::controller('role','Admin\User\RoleController');
		Route::controller('example','Admin\ExampleController');

});