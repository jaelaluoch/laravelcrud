<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function createTask(Request $request){
        $request->validate([
            'name' => 'required|string',
            "description"=>"required",
            "status_id"=>"required",
            "due_date"=>"required",
        ]);
        $task=Task::create($request->all());
        return ['status'=>true,'message'=>'Task created successfully'];
    }

    public function getTask(){
        $task = DB::select( DB::raw("SELECT *,
        (SELECT name FROM statuses B WHERE B.id=A.status_id)status
         FROM `tasks` A ORDER BY id desc") );
        return $task;
    }

    public function updateTask(Request $request){
        $request->validate([
            'name' => 'required|string',
            "description"=>"required",
            "status_id"=>"required",
            "due_date"=>"required",
        ]);
        $task=Task::find($request->id);
        $task->update($request->all());

        return ['status'=>true,'message'=>'Task updated successfully'];
    }
    public function deleteTask($id){
        $task=Task::find($id);
        $task->delete();
        return ['status'=>true,'message'=>'Task deleted successfully'];
    }
}
