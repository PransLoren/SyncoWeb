<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ClassModel;
use App\Models\SubjectModel;
use App\Models\AssignSubjectApiTeacherModel;
use Illuminate\Support\Facades\Validator;
use Auth;

class AssignSubjectApiTeacherController extends Controller
{

    public function list()
    {
        $assignments = AssignSubjectApiTeacherModel::with(['subject', 'teacher'])->get();

        return response()->json(['assignments' => $assignments, 'message' => 'Assignments retrieved successfully'], 200);
    }

    public function add(Request $request)
    {
        $subjects = SubjectModel::all();
        $teachers = User::all();
        return response()->json(['subjects' => $subjects, 'teachers' => $teachers]);
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subject_id' => 'required',
            'teacher_id' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $user = Auth::user();
        $teacherId = $request->input('teacher_id');

        $existingRecord = AssignSubjectApiTeacherModel::where('subject_id', $request->subject_id)
            ->where('teacher_id', $teacherId)
            ->first();

        if ($existingRecord) {
            $existingRecord->status = $request->status;
            $existingRecord->save();
        } else {
            AssignSubjectApiTeacherModel::create([
                'subject_id' => $request->subject_id,
                'teacher_id' => $teacherId,
                'status' => $request->status,
                'created_by' => $user->id,
            ]);
        }

        return response()->json(['message' => 'Assignment saved successfully']);
    }

    public function edit(Request $request, $id)
    {
        $record = AssignSubjectApiTeacherModel::find($id);
        if (!$record) {
            return response()->json(['error' => 'Record not found'], 404);
        }

        $subjects = SubjectModel::all();
        $teachers = User::all();

        return response()->json(['record' => $record, 'subjects' => $subjects, 'teachers' => $teachers]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'subject_id' => 'required',
            'teacher_id' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $record = AssignSubjectApiTeacherModel::find($id);
        if (!$record) {
            return response()->json(['error' => 'Record not found'], 404);
        }

        $record->subject_id = $request->subject_id;
        $record->teacher_id = $request->teacher_id;
        $record->status = $request->status;
        $record->save();

        return response()->json(['message' => 'Assignment updated successfully']);
    }
}
