<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ProjectModel;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Str;

class ProjectApiController extends Controller
{

    public function project(){

        $data['getRecord'] = ProjectModel::get();
        $data['header_title'] = 'Add New Project';
        return response()->json($data);
    }
    public function add()
    {
        $data['header_title'] = 'Add New Project';
        return response()->json($data);
    }
    
    public function insert(Request $request)
    {
        $project = new ProjectModel;
        $project->project_name = trim($request->project_name);
        $project->project_date = trim($request->project_date);
        $project->submission_date = trim($request->submission_date);
        $project->description = trim($request->description);
        $project->created_by = Auth::user()->id;

        if(!empty($request->file('document_file')))
        {
            $ext = $request->file('document_file')->getClientOriginalExtension();
            $file = $request->file('document_file');
            $randomStr = date('Ymdhis').Str::random(30);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('uploads/project/', $filename);

            $project->document_file = $filename;
        }

        $project->save();

        // Return a JSON response indicating the success message.
        return response()->json(['message' => 'Project successfully added']);
    }

    public function edit($id)
    {
        $getRecord = ProjectModel::find($id);
        if (!$getRecord) {
            return response()->json(['error' => 'Project not found'], 404);
        }

        return response()->json(['data' => $getRecord]);
    }

    public function update(Request $request, $id)
    {
        $project = ProjectModel::find($id);
        if (!$project) {
            return response()->json(['error' => 'Project not found'], 404);
        }

        $project->project_name = trim($request->project_name);
        $project->project_date = trim($request->project_date);
        $project->submission_date = trim($request->submission_date);
        $project->description = trim($request->description);
        $project->created_by = Auth::user()->id;

        if ($request->hasFile('document_file')) {
            $ext = $request->file('document_file')->getClientOriginalExtension();
            $file = $request->file('document_file');
            $randomStr = date('Ymdhis').Str::random(30);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('uploads/project/', $filename);
            $project->document_file = $filename;
        }

        $project->save();

        return response()->json(['message' => 'Project successfully updated']);
    }

    public function delete($id)
    {
        $project = ProjectModel::find($id);
        if (!$project) {
            return response()->json(['error' => 'Project not found'], 404);
        }

        $project->isDelete = 1;
        $project->save();

        return response()->json(['message' => 'Project successfully deleted']);
    }

    public function invite(Request $request, $projectId)
        {
            // Validate the incoming request data
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
            ]);
     
            if ($validator->fails()) {
                throw ValidationException::withMessages($validator->errors()->all());
            }
    
            return response()->json(['success' => 'Invitation sent successfully.']);
        }

        public function tasksubmit(Request $request)
        {
        // Validate the incoming request data
        $request->validate([
            'task_name' => 'required|string|max:255',
           
        ]);
        
        // Create a new task record
        $task = new Task();
        $task->task_name = $request->task_name;
        $descriptionWithoutNbsp = str_replace('&nbsp;', '', $request->task_description);
        $task->task_description = strip_tags($descriptionWithoutNbsp);
        $task->save();

        // Return a success response
        return response()->json(['success' => 'Task submitted successfully.']);
        }

        public function viewTask(Request $request, $taskName)
        {
            $taskName = $request->task_name;
            $task = Task::where('task_name', $taskName)->first();
            return response()->json($task);

        }

}
