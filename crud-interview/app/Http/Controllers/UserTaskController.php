<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserTask;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserTaskController extends Controller
{
    public function createUserTask(Request $request){
        $request->validate([
            'task_id' => 'required',
            "status_id"=>"required",
            "due_date"=>"required",
            "start_time"=>"required",
            "end_time"=>"required",
            "remarks"=>"required",
        ]);
        $request['user_id']=Auth::user()->id;
        $task=UserTask::create($request->all());
        return ['status'=>true,'message'=>'Task assigned successfully'];
    }

    public function getUserTask(){
        $task = DB::select( DB::raw("SELECT *,
        (SELECT name FROM statuses B WHERE B.id=A.status_id)status,
        (SELECT name FROM tasks B WHERE B.id=A.task_id)task,
        (SELECT name FROM users B WHERE B.id=A.user_id)user
         FROM `user_tasks` A ORDER BY id desc") );
        return $task;
    }

    public function updateUserTask(Request $request){
        $request->validate([
            'task_id' => 'required',
            "status_id"=>"required",
            "due_date"=>"required",
            "start_time"=>"required",
            "end_time"=>"required",
            "remarks"=>"required",
        ]);
        $task=UserTask::find($request->id);
        $task->update($request->all()); 
        return ['status'=>true,'message'=>'Task updated successfully'];
    }

    public function deleteUserTask($id){
        $task=UserTask::find($id);
        $task->delete();
        return ['status'=>true,'message'=>'User Task deleted successfully'];
    }
}
