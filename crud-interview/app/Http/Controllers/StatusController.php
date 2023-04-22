<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;

class StatusController extends Controller
{
    public function createStatus(Request $request){
        $request->validate([
            'name' => 'required|string',
        ]);
        $status=Status::create($request->all());
        return ['status'=>true,'message'=>'Status created successfully'];
    }

    public function getStatus(){
        $status=Status::orderBy('id','desc')->get();
        return $status;
    }

    public function updateStatus(Request $request){
        $request->validate([
            'name' => 'required|string',
        ]);
        $status=Status::find($request->id);
        $status->update($request->all());

        return ['status'=>true,'message'=>'Status updated successfully'];
    }
    public function deleteStatus($id){
        $status=Status::find($id);
        $status->delete();
        return ['status'=>true,'message'=>'Status deleted successfully'];
    }
}
