<?php namespace Admin\Helper;

use Admin\Helper\Admin;
use App\Models\Menu;
use App\Models\Role;

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

	public function countActionFromMenu($menu)
	{
		if($menu->actions()->count() > 0)
		{
			return $menu->actions;
		}
	}

	public function whileChildTrChecked($child,$action)
	{
		$role = Role::findOrFail($this->getId());
		
		$cek = $child->menuAction()
			->where('action_id',$action->id)
			->first()
			->rights()
			->where('role_id',$role->id)
			->first();

		$result = "";

		if(!empty($cek->id))
		{
			$result = 'checked';
		}

		return $result;
	}

	public function whileChildTr($childs,$no)
	{
		$str = "";

		$colors = ['#DAE9D1','#E9D1D9'];

		if($childs->count() > 0)
		{
			foreach($childs as $child)
			{
				$str .= "<tr style = 'background-color:".$colors[$no-1].";'>";
				$str .= "<td>".$child->title."</td>";
				$str .= "<td>";
					if(!empty($this->countActionFromMenu($child)))
					{
						foreach($child->actions as $action)
						{
							$checked = $this->whileChildTrChecked($child,$action);
							$str .= "<input $checked type = 'checkbox' name = 'menu_action_id[]' value = '".$action->pivot->id."' /> ".$action->action.'<br/>';
						}
					}
				$str .="</td>";	
				$str .= "</tr>";
				$str .= $this->whileChildTr($child->childs,$no);
			}

		}

		return $str;
	}
}