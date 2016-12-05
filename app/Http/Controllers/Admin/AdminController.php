<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Admin;
use Table;
use Image;

class AdminController extends Controller
{
    public function __construct()
    {

    }

    public function insertOrUpdate($inputs , $model)
    {
        if(!empty($model->id))
        {
            $model->update($inputs);
            $message = 'Data has been updated';
        }else{
            $model->create($inputs);
            $message = 'Data has been saved';
        }


        return redirect(Admin::urlBackendAction('index'))
            ->withSuccess($message);
    }

    public function delete($model,$images=[])
    {
        try
        {
            foreach($images as $image)
            {
                @unlink(Admin::publicContents($image));
            }

            $model->delete();

            return redirect(Admin::urlBackendAction('index'))

            ->withSuccess("Data has been deleted");

        }catch(\Exception $e){

            return redirect(Admin::urlBackendAction('index'))

            ->withSuccess("Data cannot be deleted");

        }
    }


    public function form($model,$setForm,$variables = [])
    {
        $model = $model;

        $forms = $setForm;

        return view('admin.scaffolding.form' , [
            'model'=>$model,
            'forms'=>$forms,
            'validation'=>!empty($this->validation) ? $this->validation : '',
            $variables,
        ]);
    }

    public function handleUpload($request,$model,$fieldName,$resize=[])
    {
       $image = $request->file($fieldName);

        if(!empty($image))
        {
            if(!empty($model->$fieldName))
            {
                @unlink(public_path('contents/'.$model->$fieldName));
            }

            $imageName = Admin::randomImage().'.'.$image->getClientOriginalExtension();

            $image = \Image::make($image);

            if(!empty($resize))
            {
                $image = $image->resize($resize[0],$resize[1]);
            }

            $image = $image->save(public_path('contents/'.$imageName));

            return $imageName;

        }else{

            return $model->$fieldName;
        }
    }

    public function listing($model , $fields, $variables=[])
    {
      $fieldJson = json_encode($fields);
      return view('admin.scaffolding.listing' , [
          'fields'=>$fields,
          'model'=>$model,
          $variables,
      ]);
    }

    public function listingRender($fields, $variables=[])
    {
      $fieldJson = json_encode($fields);
      return view('admin.scaffolding.listing_render' , [
          'fields'=>$fields,
          'model'=>$model,
          $variables,
      ]);
    }

    public function injectModel($model)
    {
      $model = "App\Models\\$model";

      return new $model;
    }

    public function datatablesdata()
    {

        $fields = request()->get('fields');
        $model = request()->get('model');
        $menu = request()->get('menu');
        $inst = $this->injectModel($model);
        $query = $inst->select($fields);
        $menu = Admin::getMenu($menu);

        return Table::of($query)
        ->addColumn('action' ,function($query)use($menu){
            return \Admin::linkActions($query->id,$menu);
        })
        ->make(true);
    }
}
