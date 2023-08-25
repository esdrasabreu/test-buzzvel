<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class FileRepositoryEloquent implements FileRepositoryInterface
{
    protected $model;
    public function __construct(Model $model){
        $this->model = $model;
    }

    public function store(array $data){ 
        return $this->model->create($data);
    }

    public function getList(){
        return $this->model->with('task')->get();
    }

    public function get($id){
        return $this->model->with('task')->find($id);
    }
    public function update($id, array $data){
        return $this->model->find($id)->update($data);
    }

    public function destroy($id){
        return $this->model->find($id)->delete();
    }


}