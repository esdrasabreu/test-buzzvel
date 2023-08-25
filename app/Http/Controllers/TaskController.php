<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private $service;
    public function __construct(TaskService $service){
        $this->service = $service;
    }

    public function store(Request $request){ 
        return $this->service->store([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'created_at' => Carbon::now(),
            'completed_at' => $request->status === 'completed' ? Carbon::now() : null,
            'user_id' => auth()->user()->id
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
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'updated_at' => Carbon::now(),
            'completed_at' => $request->status === 'completed' ? Carbon::now() : null,
            'user_id' => auth()->user()->id

        ], $id);
    }

    public function destroy($id){
        return $this->service->destroy($id);
    }
}
