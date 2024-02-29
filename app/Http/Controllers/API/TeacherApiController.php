<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TeacherApiController extends Controller
{
    public function list()
    {
        $admins = User::where('user_type', 2)-> where('is_delete',0)->get();
        return response()->json([
            'admins' => $admins
        ],200);
    }

    public function add(Request $request)
    {
        // You can return a response with any additional data needed for the view.
        return response()->json(['message' => 'Add New Teacher'], 200);
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'mobile_number' => 'max:15|min:8',
            // Add validation rules for other fields as needed
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $teacher = new User;
        // Populate the teacher object with request data
        $teacher->name = trim($request->name);
        $teacher->last_name = trim($request->last_name);
        $teacher->gender = trim($request->gender);
        $teacher->status = trim($request->status);
        $teacher->mobile_number = trim($request->mobile_number);
        $teacher->email = trim($request->email);
        $teacher->user_type = 2; // Assuming this is how you differentiate between teachers and other users

        if (!empty($request->date_of_birth)) {
            $teacher->date_of_birth = trim($request->date_of_birth);
        }

        if (!empty($request->file('profile_pic'))) {
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis') . Str::random(30);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('uploads/profile/', $filename);

            $teacher->profile_pic = $filename;
        }

        if (!empty($request->password)) {
            $teacher->password = Hash::make($request->password);
        }

        $teacher->save();

        return response()->json(['message' => 'Teacher added successfully'], 201);
    }

    public function edit($id)
    {
        $teacher = User::findOrFail($id);
        return response()->json(['teacher' => $teacher], 200);
    }

    public function update($id, Request $request)
    {
        $teacher = User::findOrFail($id);

        // Validate the request data
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email,' . $id,
            'mobile_number' => 'max:15|min:8',
            // Add validation rules for other fields as needed
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // Update the teacher object with request data
        $teacher->name = trim($request->name);
        $teacher->last_name = trim($request->last_name);
        $teacher->gender = trim($request->gender);
        $teacher->status = trim($request->status);
        $teacher->mobile_number = trim($request->mobile_number);
        $teacher->email = trim($request->email);

        if (!empty($request->date_of_birth)) {
            $teacher->date_of_birth = trim($request->date_of_birth);
        }

        if (!empty($request->file('profile_pic'))) {
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis') . Str::random(30);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('uploads/profile/', $filename);

            $teacher->profile_pic = $filename;
        }

        if (!empty($request->password)) {
            $teacher->password = Hash::make($request->password);
        }

        $teacher->save();

        return response()->json(['message' => 'Teacher updated successfully'], 200);
    }

    public function delete($id)
    {
        $teacher = User::findOrFail($id);
        $teacher->delete();

        return response()->json(['message' => 'Teacher deleted successfully'], 200);
    }
}
