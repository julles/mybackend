<?php namespace Admin\Helper;

use Admin\Helper\Admin;
use App\Models\Menu;

class Site extends Admin
{
	public function parents()
	{
		$model = Menu::where('parent_id','=',null)
			->orderBy('order','asc')
			->get();

		return $model;
	}

	public function countChild($model)
	{
		return $model->childs()->count();
	}

	public function isClassTreeview($model)
	{
		$count = $this->countChild($model);

		if($count > 0)
		{
			$cekParent = $this->getParentMenu($this->getMenu()->slug);
			if(!empty($cekParent->id))
			{
				if($cekParent->slug == $model->slug)
					return 'treeview active';
			}else{
				return 'treeview';
			}
			
		}else{
			return '';
		}
	}

	public function urlMenu($model)
	{
		$count = $this->countChild($model);

		if($count > 0)
		{
			return '#';
		}else{
			return $this->urlBackend($model->slug.'/index');
		}
	}

	public function parentIsNotNull()
	{
		$model = new Menu;

		$model = $model->where('controller','!=',null)
			->get();

		return $model;
	}

	public function controllerExists($row)
	{
		$controller = $row->controller;

		$changeGaring = str_replace("\\","/",$controller);

		$path = app_path("Http/Controllers/".$changeGaring.'.php');

		if(file_exists($path))
		{
			return true;
		}else{
			return false;
		}

	}

}