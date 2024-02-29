<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubjectModel;
use Auth;
use Illuminate\Support\Facades\Validator;

class SubjectApiController extends Controller
{
    public function list(){
        $records = SubjectModel::getRecord();
        return response()->json(['data' => $records, 'message' => 'Subjects retrieved successfully'], 200);
    }

    public function add(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'type' => 'required|string',
            'status' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $subject = new SubjectModel;
        $subject->name = $request->input('name');
        $subject->type = $request->input('type');
        $subject->status = $request->input('status');
        $subject->created_by = Auth::user()->id;
        $subject->save();

        return response()->json(['message' => 'Subject successfully created', 'data' => $subject], 201);
    }

    public function edit($id){
        $record = SubjectModel::find($id);

        if (!$record) {
            return response()->json(['error' => 'Subject not found'], 404);
        }

        return response()->json(['data' => $record, 'message' => 'Subject retrieved successfully'], 200);
    }

    public function update($id, Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'string',
            'type' => 'string',
            'status' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $subject = SubjectModel::find($id);

        if (!$subject) {
            return response()->json(['error' => 'Subject not found'], 404);
        }

        $subject->name = $request->input('name', $subject->name);
        $subject->type = $request->input('type', $subject->type);
        $subject->status = $request->input('status', $subject->status);
        $subject->save();

        return response()->json(['message' => 'Subject successfully updated', 'data' => $subject], 200);
    }

    public function delete($id){
        $subject = SubjectModel::find($id);

        if (!$subject) {
            return response()->json(['error' => 'Subject not found'], 404);
        }

        $subject->delete();

        return response()->json(['message' => 'Subject successfully deleted'], 200);
    }
}
