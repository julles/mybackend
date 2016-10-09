<?php namespace Admin\Helper;

use Html;
use App\Models\Menu;

class Admin
{
	/**
	 * Mengambil variable backendUrl di file admin.php
	 * @return [string]
	 */
	public function backendUrl()
	{
		return config('admin.backendUrl');
	}

	/**
	 * Mengambil variable projectName di file admin.php
	 * @return [string]
	 */
	public function projectName()
	{
		return config('admin.projectName');
	}

	/**
	 * asset path di tambahin adminlte, jadi bisa dinamis kalo path css adminlte berubah
	 * @return [string]
	 */
	public function assetAdmin($plus="")
	{
		return asset('adminlte');
	}

	/**
	 * mengambil data prefix di route group admin
	 * @return [string] 
	 */
	public function getPrefix()
	{
		return request()->route()->getPrefix();
	}

	/**
	 * mengambil method action controller
	 * @return [string] ex : getIndex(),getUpdate()
	 */
	public function getAction()
	{
		$currentRoute =  request()->route()->getActionName();
		$explode = explode('@',$currentRoute);
		return $explode[1];
	}

	/**
	 * mengambil action di url 
	 * @return [string] ex : index,update,delete
	 */
	public function rawAction()
	{
		$url =  request()->url();	
		$arr = explode("/",$url);
		$count = count($arr);
		$end = end($arr);
		$min = is_numeric($end) ? 2 : 1;
		return $arr[$count-$min];	
	}

	/**
	 * mengambil menu di url 
	 * @return [string] ex : role,user,ect.
	 */
	public function rawMenu()
	{
		$url =  request()->url();	
		$arr = explode("/",$url);
		$count = count($arr);
		$end = end($arr);
		$min = is_numeric($end) ? 3 : 2;
		return $arr[$count-$min];
	}

	/**
	 * Mereturn data satu record dari table menu by parameter slug
	 * kalo slug kosong maka parameter pembanding yang diambil method rawMenu()
	 * @param  string $slug [paramter pembanding slug]
	 * @return [string]
	 */
	public function getMenu($slug = "")
	{
		$model = new Menu;

		if(!empty($slug))
		{
			$model = $model->whereSlug($slug);
		}else{
			$model = $model->whereSlug($this->rawMenu());
		}
		
		return $model->first();
	}

	public function getParentMenu($slug = "")
	{
		$menu = $this->getMenu($slug);

		return $menu->parent;
	}

	public function labelMenu($slug="")
	{
		return $this->getMenu($slug)->title;
	}

	public function labelParentMenu($slug="")
	{
		return $this->getParentMenu($slug)->title;
	}

	public function labelAction()
	{
		$action = $this->rawAction();
	
		if($action == 'index')
		{
			$result = 'List';
		}else{
			$result = ucwords($action);
		}

		return $result;
	}

	public function urlBackend($menu)
	{
		$prefix = $this->getPrefix();

		if($prefix == '/')
		{
			$prefix = "";
		}

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

	public function linkUpdate($plus="")
	{
		return Html::link($this->urlBackendAction('update/'.$plus),'Update',[
			'class'=>'btn btn-success btn-sm'
		]);
	}

	public function linkDelete($plus="")
	{
		return Html::link($this->urlBackendAction('delete/'.$plus),'Delete',[
			'class'=>'btn btn-danger btn-sm',
			'onclick'=>'return confirm("Are you sure want to delete this item ?")'
		]);
	}

	public function linkActions($plus="")
	{
		return $this->linkUpdate($plus).' | '.$this->linkDelete($plus);
	}

	public function randomImage()
	{
		return md5(date("YmdHis"));
	}

	public function publicContents($file)
	{
		return public_path('contents/'.$file);
	}

	public function assetContents($file)
	{
		return asset('contents/'.$file);
	}

	public function getId()
	{
		$url = request()->url();
		$ex = explode("/",$url);
		return end($ex);
	}

	public function inject($model)
	{
		$model =  "App\Models\\$model";
	
		return new $model;
	}

	public function addMenu($params=[])
	{

	}
}