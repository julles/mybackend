<?php

namespace App\Http\Controllers\Admin\User;

use Illuminate\Http\Request;
use Admin;
use Site;
use App\Http\Requests;
use App\Http\Controllers\Admin\AdminController;
use Table;
use App\Models\Role;
use App\Models\Menu;
use App\Models\Right;
use DB;

class RoleController extends AdminController
{
	public function __construct(Role $model)
	{
        parent::__construct();
		$this->model = $model;
        $this->view = 'admin.user.role.';
        $this->validation = 'App\Http\Requests\Admin\User\Role';
    }

    public function setForm()
    {
        $forms = [
            'role' => [
                'type'=>'text',
                'label'=>'Role',
                'properties'=>['class'=>'form-control']
            ],
        ];

        return $forms;
    }

	  public function getData()
    {
        $fields = [
            'id',
            'role',
        ];

        $model = $this->model->select($fields);

        return Table::of($model)
        ->addColumn('action' ,function($model){
            if($model->id != 1)
            {
                return Admin::linkActions($model->id);
            }else{
                return '-';
            }
        })
        ->make(true);
    }

    public function getIndex()
    {
        return view($this->view.'index');
    }

    public function getCreate()
    {
        return $this->form($this->model,$this->setForm());
    }

    public function postCreate(Requests\Admin\User\Role $request)
    {
    	return $this->insertOrUpdate($request->all(),$this->model);
    }

    public function getUpdate($id)
    {
        $model = $this->model->findOrFail($id);

        $this->exception($model);

        return $this->form($model,$this->setForm());
    }

    public function postUpdate(Requests\Admin\User\Role $request,$id)
    {
        $model = $this->model->findOrFail($id);

        $this->exception($model);

        return $this->insertOrUpdate($request->all(),$model);
    }

    public function getDelete($id)
    {
        $model = $this->model->findOrFail($id);

        $this->exception($model);

        return $this->delete($model);
    }

    public function getView($id)
    {
        $model = $this->model->findOrFail($id);

        $this->exception($model);

        $menus = Site::parents();

        return view($this->view.'view',[
            'model'=>$model,
            'menus'=>$menus,
        ]);
    }

    public function postView(Request $request , $id)
    {
        $count = count($request->menu_action_id);
        $role = $this->model->findOrFail($id);
        // DB::beginTransaction();

        try
        {
            $data = [];
            $role->rights()->delete();
            for($a=0;$a<$count;$a++)
            {
                $menu_action_id = $request->menu_action_id[$a];
                if(!empty($menu_action_id))
                {
                    $data[] = [
                        'role_id'=>$role->id,
                        'menu_action_id'=>$menu_action_id,
                    ];
                }
            }

            Right::insert($data);

            DB::commit();
            return redirect(Admin::urlBackendAction('index'))
                ->with('success','Data has beeen updated');
        }catch(\Exception $e){
            DB::rollback();
            return redirect(Admin::urlBackendAction('index'))
                ->with('info','Data cannot be updated'.json_encode($e));
        }
    }

    public function exception($model)
    {
        if($model->id == 1)
        {
           throw new \Exception("Maaf Superadmin tidak bisa dihapus atau di update :) silahkan cek method exception()", 1);

        }
    }
}
