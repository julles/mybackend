<?php namespace Admin\Facades;

use Illuminate\Support\Facades\Facade;

class SiteFacade extends Facade
{
	public static function getFacadeAccessor()
	{
		return 'register-site';
	}
}