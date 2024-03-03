<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\ProjectModel;
use App\Models\SubjectModel;

class DashboardController extends Controller
{
    public function dashboard(){
        $data['header_title'] = "Dashboard";
        if(Auth::user()->user_type == 1){
            $data['getTeacher'] = User::getTeacher();
            $data['header_title'] = "Teacher List";
            $data['getStudent'] = User::getStudent();
            $data['header_title'] = "Student List";
            $data['getRecord'] = SubjectModel::getRecord();
            $data['header_title'] = "Subject List";
            return view('Admin.admindash', $data);
        }
        elseif(Auth::user()->user_type == 3){
            $data['getRecord'] = ProjectModel::getRecord();
            $data['header_title'] = 'Project';
            return view('Student.studentdash', $data);
        }
    }
}
