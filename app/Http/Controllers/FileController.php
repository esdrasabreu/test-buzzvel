<?php

namespace App\Http\Controllers;
use App\Services\FileService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FileController extends Controller
{
    private $service;
    public function __construct(FileService $service){
        $this->service = $service;
    }

    public function store(Request $request){ 
        return $this->service->store([
            'file_path' => $request->file_path,
            'task_id' => $request->task_id,
            'created_at' => Carbon::now()
        ]);
    }

    public function getList(){
        return $this->service->getList();
    }

    public function get($id){
        return $this->service->get($id);
    }
    public function update($id, Request $request){
        return $this->service->update([
            'file_path' => $request->file_path,
            'task_id' => $request->task_id,
            'updated_at' => Carbon::now()
        ], $id);
    }

    public function destroy($id){
        return $this->service->destroy($id);
    }
}
