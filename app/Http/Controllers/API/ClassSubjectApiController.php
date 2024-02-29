<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use App\Models\ClassSubjectModel;
use App\Models\SubjectModel;
use Illuminate\Http\Request;
use Auth;

class ClassSubjectApiController extends Controller
{
    public function list(){
        $classSubject = ClassSubjectModel::all();
        return response()->json(['classSubject' => $classSubject],200);
    }

    public function add (Request $request){
        $classes = ClassModel::all();
        $subjects = SubjectModel::all();
        return response()->json(['class_subject' => $classes,'subject' => $subjects],200);
    }

    public function insert(Request $request)
    {
        $this->validate($request, [
            'class_id' => 'required|exists:class,id',
            'subject_ids' => 'required|array',
            'subject_ids.*' => 'exists:subject,id',
            'status' => 'required|boolean',
        ]);
    
        foreach ($request->subject_ids as $subject_id) {
            $existingAssignment = ClassSubjectModel::where('class_id', $request->class_id)
                ->where('subject_id', $subject_id)
                ->first();
    
            if ($existingAssignment) {
                $existingAssignment->status = $request->status;
                $existingAssignment->save();
            } else {
                $newAssignment = new ClassSubjectModel;
                $newAssignment->class_id = $request->class_id;
                $newAssignment->subject_id = $subject_id;
                $newAssignment->status = $request->status;
                $newAssignment->created_by = Auth::id();
                $newAssignment->save();
            }
        }
    
        return response()->json(['message' => 'Class subjects inserted successfully'], 201);
    }

    public function edit($id)
    {
        $classSubject = ClassSubjectModel::find($id);
        if (!$classSubject) {
            return response()->json(['error' => 'Class subject not found'], 404);
        }

        $classes = ClassModel::all();
        $subjects = SubjectModel::all();

        return response()->json(['classSubject' => $classSubject, 'class' => $classes, 'subject' => $subjects], 200);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'status' => 'required|boolean',
        ]);

        $classSubject = ClassSubjectModel::find($id);

        if (!$classSubject) {
            return response()->json(['error' => 'Class subject not found'], 404);
        }

        $classSubject->status = $request->status;
        $classSubject->save();

        return response()->json(['message' => 'Class subject updated successfully'], 200);
    }

    public function delete($id)
    {
        $classSubject = ClassSubjectModel::find($id);
        if (!$classSubject) {
            return response()->json(['error' => 'Class subject not found'], 404);
        }

        $classSubject->delete();

        return response()->json(['message' => 'Class subject deleted successfully'], 200);
    }

    public function getSingle($id)
    {
        $getRecord = ClassSubjectModel::getSingle($id);

        if (!empty($getRecord)) {
            $data['getRecord'] = $getRecord;
            $data['getClass'] = ClassModel::getClass();
            $data['getSubject'] = SubjectModel::getSubject();
            $data['header_title'] = 'Edit Assign Subject';
            return response()->json($data);
        } else {
            return response()->json(['error' => 'Record not found'], 404);
        }
    }

    public function updateSingle($id, Request $request)
    {
        $getAlreadyFirst = ClassSubjectModel::getAlreadyFirst($request->class_id, $request->subject_id);

        if (!empty($getAlreadyFirst)) {
            $getAlreadyFirst->status = $request->status;
            $getAlreadyFirst->save();

            return response()->json(['message' => 'Subject Successfully Updated'], 200);
        } else {
            $save = ClassSubjectModel::getSingle($id);
            $save->class_id = $request->class_id;
            $save->subject_id = $request->subject_id;
            $save->status = $request->status;
            $save->save();

            return response()->json(['message' => 'Subject successfully assign to class'], 200);
        }
    }

    
}
