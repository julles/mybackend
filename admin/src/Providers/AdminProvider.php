<?php namespace Admin\Providers;

use Illuminate\Support\ServiceProvider;

use Admin\Helper\Admin;

class AdminProvider extends ServiceProvider
{
	public function boot()
	{

	}

	public function register()
	{
		// return $this->mergeConfigFrom(
		// 	config_path('admin.php'), 'admin'
		// );

		$this->app->bind('register-admin' , function(){
			return new Admin;
		});
	}
}