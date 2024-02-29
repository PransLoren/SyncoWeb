<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassModel;
use Auth;

class ClassApiContoller extends Controller
{
    public function list(){
        $classes = ClassModel::getRecord();
        return response()->json([
            'classes' => $classes
        ],200);
    }

    public function add(Request $request){
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);
    
        $user = Auth::user();
    
        $class = new ClassModel;
        $class->name = $request->name;
        $class->status = $request->status;
        $class->created_by = $user->id;
        $class->save();
    
        return response()->json([
          'message' => 'Class Successfully Created'
        ], 201);
    }

    
    public function edit($id)
    {
        $class = ClassModel::find($id);

        if (!$class) {
            return response()->json(['error' => 'Class not found'], 404);
        }

        return response()->json(['class' => $class], 200);
    }

    public function update($id, Request $request)
    {
        $class = ClassModel::find($id);

        if (!$class) {
            return response()->json(['error' => 'Class not found'], 404);
        }

        $class->name = $request->input('name');
        $class->status = $request->input('status');
        $class->save();

        return response()->json(['message' => 'Class successfully updated'], 200);
    }

    public function delete($id)
    {
        $class = ClassModel::find($id);

        if (!$class) {
            return response()->json(['error' => 'Class not found'], 404);
        }

        $class->delete();

        return response()->json(['message' => 'Class successfully deleted'], 200);
    }

    

    
}
