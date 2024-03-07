<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
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
        $project->save();



        return redirect('student/')->with('success','Project successfully added');
    }

    public function invitedProjects()
    {
        // Retrieve the projects that the current user has been invited to
        $invitedProjects = Auth::user()->projects()->paginate(10);

        // Pass the data to the view
        return view('student/dashboard', compact('invitedProjects'));
    }


        public function edit($id)
        {
            $getRecord = ProjectModel::findOrFail($id);
            $data['getRecord'] = $getRecord;
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

            return redirect('student/dashboard')->with('success','Project successfully submit')->with('confirmation', 'Project successfully submit');;

        }

        public function tasksubmit(Request $request, $projectId)
        {
            // Validate the incoming request data
            $request->validate([
                'task_name' => 'required|string|max:255',
                'task_description' => 'required|string',
            ]);
            
            // Find the project by its ID
            $project = ProjectModel::findOrFail($projectId);
            
            // Create a new task record associated with the project
            $task = new Task();
            $task->task_name = $request->task_name;
            $task->task_description = $request->task_description;
            
            // Associate the task with the project
            $project->tasks()->save($task);
        
            // Return a success response
            return response()->json(['success' => 'Task submitted successfully.']);
        }
        

    public function viewTasks($projectId)
    {
        $project = ProjectModel::with('tasks')->findOrFail($projectId);
    
        return view('Student.viewTask', compact('project'));
    }
    
}
