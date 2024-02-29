<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\SubjectModel;
use Hash;
use Auth;
use Str;
use Illuminate\Http\Request;


class studentListController extends Controller
{
    public function studentList()
    {
        $data['getStudent'] = User::getStudent();
        $data['header_title'] = "Student List";
        return view('Admin.admin.studentlist.studentlist',$data);
    }

    public function add()
    {
        $data['getSubject'] = SubjectModel::getSubject();
        $data['header_title'] = "Add New Student";
        return view('Admin.admin.studentlist.addStudent',$data);
    }

    public function insert(Request $request){
        request()->validate([
            'email' => 'required|email|unique:users'
        ]);

        $student = new User;
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->gender = trim($request->gender);
        $student->class_id = trim($request->class_id);
        if(!empty($request->date_of_birth)){
            $student->date_of_birth = trim($request->date_of_birth);
        }
        if(!empty($request->file('profile_pic'))){
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis').Str::random(30);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('uploads/profile/', $filename);

            $student->profile_pic = $filename;
        }
        $student->status = trim($request->status);
        $student->email = trim($request->email);
        $student->password = Hash::make($request->password);
        $student->user_type = 3;
        $student->save();

        return redirect('admin/student/list')->with('success','Student Successful Created');
    }

    public function edit($id)
    {
        $data['getStudent'] = User::getSingle($id);

        if (!empty($data['getStudent'])) {
            $data['getSubject'] = SubjectModel::getSubject();
            $data['header_title'] = 'Edit Student';
            return view('Admin.admin.studentlist.editStudent', $data);
        } else {
            abort(404);
        }
    }

    public function update($id, Request $request)
    {

        request()->validate([
            'email' => 'required|email|unique:users'.$id
        ]);

        $student = User::getSingle($id);
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->gender = trim($request->gender);
        $student->subject_id = trim($request->subject_id);
        if(!empty($request->date_of_birth)){
            $student->date_of_birth = trim($request->date_of_birth);
        }
        if(!empty($request->file('profile_pic'))){
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis').Str::random(30);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('uploads/profile/', $filename);

            $student->profile_pic = $filename;
        }
        $student->status = trim($request->status);
        $student->email = trim($request->email);
        if(!empty($request->password))
        {
            $student->password = Hash::make($request->password);
        }
        $student->save();

        return redirect('admin/student/list')->with('success','Student Successful Updated');
        

    }

    public function delete($id)
    {
        
        $getStudent = User::getSingle($id);

        if (!empty($getRecord)) {
            $getStudent->is_delete = 1;
            $getStudent->save();

            return redirect()->back()->with('success','Student Successful Deleted');
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


    //manager studentlistController
    public function studentLists()
    {
        $data['getStudent'] = User::getStudent();
        $data['header_title'] = "Student List";
        return view('Manager.StudentList.StudentLists',$data);
    }

    public function addStudent()
    {
        $data['getSubject'] = SubjectModel::getSubject();
        $data['header_title'] = "Add New Student";
        return view('Manager.StudentList.addStudent',$data);
    }

    public function insertStudent(Request $request){
        request()->validate([
            'email' => 'required|email|unique:users'
        ]);

        $student = new User;
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->gender = trim($request->gender);
        $student->class_id = trim($request->class_id);
        if(!empty($request->date_of_birth)){
            $student->date_of_birth = trim($request->date_of_birth);
        }
        if(!empty($request->file('profile_pic'))){
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis').Str::random(30);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('uploads/profile/', $filename);

            $student->profile_pic = $filename;
        }
        $student->status = trim($request->status);
        $student->email = trim($request->email);
        $student->password = Hash::make($request->password);
        $student->user_type = 3;
        $student->save();

        return redirect('manager/student/list')->with('success','Student Successful Created');
    }

    public function editStudent($id)
    {
        $data['getStudent'] = User::getSingle($id);

        if (!empty($data['getStudent'])) {
            $data['getSubject'] = SubjectModel::getSubject();
            $data['header_title'] = 'Edit Student';
            return view('Manager.StudentList.editStudent', $data);
        } else {
            abort(404);
        }
    }

    public function updateStudent($id, Request $request)
    {

        request()->validate([
            'email' => 'required|email|unique:users'.$id
        ]);

        $student = User::getSingle($id);
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->gender = trim($request->gender);
        $student->subject_id = trim($request->subject_id);
        if(!empty($request->date_of_birth)){
            $student->date_of_birth = trim($request->date_of_birth);
        }
        if(!empty($request->file('profile_pic'))){
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis').Str::random(30);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('uploads/profile/', $filename);

            $student->profile_pic = $filename;
        }
        $student->status = trim($request->status);
        $student->email = trim($request->email);
        if(!empty($request->password))
        {
            $student->password = Hash::make($request->password);
        }
        $student->save();

        return redirect('manager/student/list')->with('success','Student Successful Updated');
        

    }

    public function deleteStudent($id)
    {
        
        $getStudent = User::getSingle($id);

        if (!empty($getRecord)) {
            $getStudent->is_delete = 1;
            $getStudent->save();

            return redirect()->back()->with('success','Student Successful Deleted');
        } else {
            abort(404);
        }
    }

    /*public function MyStudent($id){
        $data['getRecord'] = (array) User::getTeacherStudent(Auth::user()->id);
        $data['header_title'] = 'My Student List';
        return view('Admin.admin.teacher.my_student',$data);
    }*/

}
    
