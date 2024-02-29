<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\SubjectModel;
use Illuminate\Http\Request;

class taskController extends Controller
{
    public function Assigned()
    {
        return view('Student.taskProgress.assigned');
    }

    public function Accept()
    {
        return view('Student.taskProgress.accept');
    }

    public function Done()
    {
        return view('Student.taskProgress.done');
    }
}

