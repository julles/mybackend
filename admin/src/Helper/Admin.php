<?php namespace Admin\Helper;

use Html;

class Admin
{
	public function backendUrl()
	{
		return config('admin.backendUrl');
	}

	public function projectName()
	{
		return config('admin.projectName');
	}

	public function assetAdmin($plus="")
	{
		return asset('adminlte');
	}

	public function getPrefix()
	{
		return request()->route()->getPrefix();
	}

	public function urlBackend($menu)
	{
		$prefix = $this->getPrefix();

		return url($prefix.'/'.$menu);
	}

	public function  urlBackendAction($action)
	{
		$prefix = $this->getPrefix();
		if($prefix == '/')
		{
			$menu = request()->segment(1);
			$result = $menu.'/'.$action;
		}else{
			$menu = request()->segment(2);
			$result = $prefix.'/'.$menu.'/'.$action;
		}

		return url($result);
	}

	public function linkCreate()
	{
		return Html::link($this->urlBackendAction('create'),'Create',[
			'class'=>'btn btn-primary'
		]);
	}

}