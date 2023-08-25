<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class TaskRepositoryEloquent implements TaskRepositoryInterface
{
    protected $model;
    public function __construct(Model $model){
        $this->model = $model;
    }

    public function store(array $data){ 
        return $this->model->create($data);
    }

    public function getList(){
        return $this->model->with('user')->get();
    }

    public function get($id){
        return $this->model->with('user')->find($id);
    }
    public function update($id, array $data){
        return $this->model->find($id)->update($data);
    }

    public function destroy($id){
        return $this->model->find($id)->delete();
    }


}