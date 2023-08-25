<?php
namespace App\Services;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Repositories\TaskRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Carbon\Carbon;

class TaskService
{
    private $repo;
    public function __construct(TaskRepositoryInterface $repo){
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
        $task = $this->repo->get($id);

        if (!$task) {
            return "Task with ID $id does not exist.";
        }

        return $task;
    }
    public function update(array $data, $id){
        $existingTask = $this->repo->get($id);

        if (!$existingTask) {
            return "Task with ID $id does not exist.";
        }

        $this->validateData($data);
        $this->repo->update($id, $data);

        return $this->repo->get($id); 
    }

    public function destroy($id){
        try {
            $task = $this->repo->get($id);
        
            if ($task) {
                $this->repo->destroy($id); 
                $message = "Task with ID $id has been successfully deleted.";
            } else {
                $message = "Task with ID $id was not found.";
            }
        } catch (ModelNotFoundException $e) {
            $message = "Task with ID $id was not found.";
        }
        
        return response()->json(['message' => $message]);
    }

    private function validateData(array $data)
    {
        $validator = Validator::make($data, [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:pending,completed',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}