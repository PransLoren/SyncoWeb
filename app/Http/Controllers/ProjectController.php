<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubjectModel;
use App\Models\ProjectModel;
use App\Models\User;
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
        $data['getSubject'] = SubjectModel::getSubject();
        $data['header_title'] = 'Add New Project';
        return view('Admin.admin.homework.add', $data);
    }
    public function insert(Request $request)
    {
        $project = new ProjectModel;
        $project->class_name = $request->class_name;
        $project->subject_name = $request->subject_name;
        $project->project_date = $request->project_date;
        $project->submission_date = $request->submission_date;
        $project->description = $request->description;
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

    public function ajax_get_subject(Request $request)
    {
        $class_id = $request->class_id;
        $getSubject = SubjectModel::MySubject($class_id);
        $html = '';
        $html .= '<option value="">Select Subject</option>';
        foreach ($getSubject as $value)
        {
            $html .= 'option value=""'.$value->subject_id.'">' .$value->subject_name.'</option>';
        }
        $json['success'] = $html;
        echo json_encode($json);
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

            return redirect()->back()->with('success','Project successfully submit');

        }
}