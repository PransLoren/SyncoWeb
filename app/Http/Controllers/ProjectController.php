<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\SubjectModel;
use App\Models\ProjectModel;
use App\Models\User;
use App\Models\Task; 
use Auth;
use Str;


class ProjectController extends Controller
{
    public function project(){
        $data['getRecord'] = ProjectModel::getRecord();
        $data['header_title'] = 'Project';
        return view('Admin.admin.homework.list1', $data);
    }
    
    public static function add(){
        $data['header_title'] = 'Add New Project';
        return view('Admin.admin.homework.add', $data);
    }
    public function insert(Request $request)
    {
        $project = new ProjectModel;
        $project->class_name = $request->class_name;
        $project->project_date = $request->project_date;
        $project->submission_date = $request->submission_date;
        $descriptionWithoutNbsp = str_replace('&nbsp;', '', $request->description);
        $project->description = strip_tags($descriptionWithoutNbsp);
        $project->created_by = Auth::user()->id;

        if(!empty($request->file('document_file'))){
            $ext = $request->file('document_file')->getClientOriginalExtension();
            $file = $request->file('document_file');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('uploads/project/', $filename);

            $project->document_file = $filename;
        }

        $project->save();

        return redirect('admin/project/list')->with('success','Project successfully added');
    }


        public function edit($id)
        {
            $getRecord = ProjectModel::getSingle($id);
            $data['getRecord'] = $getRecord;
            $data ['getSubject'] = SubjectModel::getSubject();
            $data['getSubject'] = SubjectModel::getSubject();
            $data['header_title'] = 'Edit Project';
            return view('Admin.admin.homework.edit', $data);
        }

        public function update(Request $request, $id)
        {
            $project = ProjectModel::getSingle($id);
            $project->class_name = trim($request->class_name);
            $project->subject_name = trim($request->subject_name);
            $project->project_date = trim($request->project_date);
            $project->submission_date = trim($request->submission_date);
            $project->description = trim($request->description);
    
            if(!empty($request->file('document_file'))){
                $ext = $request->file('document_file')->getClientOriginalExtension();
                $file = $request->file('document_file');
                $randomStr = date('Ymdhis').Str::random(20);
                $filename = strtolower($randomStr).'.'.$ext;
                $file->move('uploads/project/', $filename);
    
                $project->document_file = $filename;
            }
    
            $project->save();
    
            return redirect('admin/project/list')->with('success','Project successfully updated');
        }

        public function delete($id)
        {
            $project = ProjectModel::getSingle($id);
            $project->is_delete = 1;
            $project->save();

            return redirect()->back()->with('success','Project successfully deleted');

        }

        public function submit($id)
        {
            $project = ProjectModel::getSingle($id);
            $project->is_delete = 2;
            $project->save();

            return redirect('student/project/list')->back()->with('success','Project successfully submit')->with('confirmation', 'Project successfully submit');;

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