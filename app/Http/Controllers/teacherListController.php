<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\SubjectModel;
use Hash;
use Auth;
use Str;
use Illuminate\Http\Request;


class teacherListController extends Controller
{
    public function teacherList()
    {
        $data['getTeacher'] = User::getTeacher();
        $data['header_title'] = "Teacher List";
        return view('Admin.admin.teacherlist.teacherlists',$data);
    }

    public function add()
    {
        $data['getSubject'] = SubjectModel::getSubject();
        $data['header_title'] = "Add New Teacher";
        return view('Admin.admin.teacherlist.addTeachers',$data);
    }

    public function insert(Request $request){
        request()->validate([
            'email' => 'required|email|unique:users'
        ]);

        $teacher = new User;
        $teacher->name = trim($request->name);
        $teacher->last_name = trim($request->last_name);
        $teacher->gender = trim($request->gender);
        $teacher->class_id = trim($request->class_id);
        if(!empty($request->date_of_birth)){
            $teacher->date_of_birth = trim($request->date_of_birth);
        }
        if(!empty($request->file('profile_pic'))){
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis').Str::random(30);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('uploads/profile/', $filename);

            $teacher->profile_pic = $filename;
        }
        $teacher->status = trim($request->status);
        $teacher->email = trim($request->email);
        $teacher->password = Hash::make($request->password);
        $teacher->user_type = 2;
        $teacher->save();

        return redirect('admin/teacher/list')->with('success','Student Successful Created');
    }

    public function edit($id)
    {
        $data['getTeacher'] = User::getSingle($id);

        if (!empty($data['getTeacher'])) {
            $data['getSubject'] = SubjectModel::getSubject();
            $data['header_title'] = 'Edit Student';
            return view('Admin.admin.teacherlist.editTeachers', $data);
        } else {
            abort(404);
        }
    }

    public function update($id, Request $request)
    {

        request()->validate([
            'email' => 'required|email|unique:users'.$id
        ]);

        $teacher = User::getSingle($id);
        $teacher->name = trim($request->name);
        $teacher->last_name = trim($request->last_name);
        $teacher->gender = trim($request->gender);
        $teacher->subject_id = trim($request->subject_id);
        if(!empty($request->date_of_birth)){
            $teacher->date_of_birth = trim($request->date_of_birth);
        }
        if(!empty($request->file('profile_pic'))){
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis').Str::random(30);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('uploads/profile/', $filename);

            $teacher->profile_pic = $filename;
        }
        $teacher->status = trim($request->status);
        $teacher->email = trim($request->email);
        if(!empty($request->password))
        {
            $teacher->password = Hash::make($request->password);
        }
        $teacher->save();

        return redirect('admin/teacher/list')->with('success','Teacher Successful Updated');
        

    }

    public function delete($id)
    {
        
        $getTeacher = User::getSingle($id);

        if (!empty($getTeacher)) {
            $getTeacher->is_delete = 1;
            $getTeacher->save();

            return redirect()->back()->with('success','Teacher Successful Deleted');
        } else {
            abort(404);
        }
    }

    /*public function MyStudent($id){
        $data['getRecord'] = (array) User::getTeacherStudent(Auth::user()->id);
        $data['header_title'] = 'My Student List';
        return view('Admin.admin.teacher.my_student',$data);
    }*/

    public function MyStudent($id){
        $data['getRecord'] = User::getTeacherStudent(Auth::user());
        $data['header_title'] = 'My Student List';
        return view('Admin.admin.teacher.my_student',$data);
    }




    //manager teacherListController
    public function teacherLists()
    {
        $data['getTeacher'] = User::getTeacher();
        $data['header_title'] = "Teacher List";
        return view('Manager.TeacherList.TeacherLists',$data);
    }

    public function addTeacher()
    {
        $data['getSubject'] = SubjectModel::getSubject();
        $data['header_title'] = "Add New Teacher";
        return view('Manager.TeacherList.addTeacher',$data);
    }

    public function insertTeacher(Request $request){
        request()->validate([
            'email' => 'required|email|unique:users'
        ]);

        $teacher = new User;
        $teacher->name = trim($request->name);
        $teacher->last_name = trim($request->last_name);
        $teacher->gender = trim($request->gender);
        $teacher->class_id = trim($request->class_id);
        if(!empty($request->date_of_birth)){
            $teacher->date_of_birth = trim($request->date_of_birth);
        }
        if(!empty($request->file('profile_pic'))){
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis').Str::random(30);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('uploads/profile/', $filename);

            $teacher->profile_pic = $filename;
        }
        $teacher->status = trim($request->status);
        $teacher->email = trim($request->email);
        $teacher->password = Hash::make($request->password);
        $teacher->user_type = 2;
        $teacher->save();

        return redirect('manager/teacher/list')->with('success','Teacher Successful Created');
    }

    public function editTeacher($id)
    {
        $data['getTeacher'] = User::getSingle($id);

        if (!empty($data['getTeacher'])) {
            $data['getSubject'] = SubjectModel::getSubject();
            $data['header_title'] = 'Edit Student';
            return view('Manager.TeacherList.editTeacher', $data);
        } else {
            abort(404);
        }
    }

    public function updateTeacher($id, Request $request)
    {

        request()->validate([
            'email' => 'required|email|unique:users'.$id
        ]);

        $teacher = User::getSingle($id);
        $teacher->name = trim($request->name);
        $teacher->last_name = trim($request->last_name);
        $teacher->gender = trim($request->gender);
        $teacher->subject_id = trim($request->subject_id);
        if(!empty($request->date_of_birth)){
            $teacher->date_of_birth = trim($request->date_of_birth);
        }
        if(!empty($request->file('profile_pic'))){
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis').Str::random(30);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('uploads/profile/', $filename);

            $teacher->profile_pic = $filename;
        }
        $teacher->status = trim($request->status);
        $teacher->email = trim($request->email);
        if(!empty($request->password))
        {
            $teacher->password = Hash::make($request->password);
        }
        $teacher->save();

        return redirect('manager/teacher/list')->with('success','Teacher Successful Updated');
        

    }

    public function deleteTeacher($id)
    {
        
        $getTeacher = User::getSingle($id);

        if (!empty($getTeacher)) {
            $getTeacher->is_delete = 1;
            $getTeacher->save();

            return redirect()->back()->with('success','Teacher Successful Deleted');
        } else {
            abort(404);
        }
    }
}
    

