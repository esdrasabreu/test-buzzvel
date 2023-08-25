<?php
namespace App\Services;

use App\Repositories\FileRepositoryInterface;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class FileService
{
    private $repo;
    public function __construct(FileRepositoryInterface $repo){
        $this->repo = $repo;
    }

    public function store(array $data){ 
        $this->validateData($data);
        return $this->repo->store($data);
    }

    public function getList(){
        return $this->repo->getList();
    }

    public function get($id){
        return $this->repo->get($id);
    }
    public function update($id, array $data){
        $this->validateData($data);
        return $this->repo->update($data, $id);
    }

    public function destroy($id){
        return $this->repo->destroy($id);
    }

    private function validateData(array $data)
    {
        $validator = Validator::make($data, [
            'file_path' => 'required|string|max:255',
            'task_id' => 'required|integer|exists:tasks,id',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}