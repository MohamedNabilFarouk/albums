<?php

namespace App\Traits;

trait CrudTrait
{
    protected $model;
    public function getModel($modelClass): string
    {
        $this->model = $modelClass;
        return $this->model ;
    }
    // protected function getModel(): string
    // {
    //     // Replace 'YourModel' with the actual name of your Eloquent model
    //     return 'App\Models\Region';
    // }
    public function getIndex() {
        $data = $this->model::all();
            return $data;
    }

    public function getStore($request){

      $row=  $this->model::create($request);
        return $row;
    }
    public function getUpdate($request,$id){
        $row = $this->model::findOrFail($id);
        $row->update($request);
        return $row;
    }
    public function getDestroy($id){
        $row =$this->model::findOrFail($id);
        $row->delete();
        return true;
    }

}

