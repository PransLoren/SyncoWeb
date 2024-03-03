<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubjectModel;
use Auth;

class SubjectController extends Controller
{
    public function subjectList()
    {
        $data['getRecord'] = SubjectModel::getRecord();

        $data['header_title'] = "Subject List";
        return view('Admin.admin.classlist.classlist', $data);
    }

    public function add()
    {
        $data['header_title'] = 'Add New Subject';
        return view('Admin.admin.classlist.addClass', $data);
    }

    public function insert(Request $request)
    {
        $save = new SubjectModel;
        $save->name = $request->name;
        $save->status = $request->status;
        $save->created_by = Auth::user()->id;
        $save->save();

        return redirect('admin/subject/list')->with('success','Subject successfully added');
    
    }

    public function edit($id)
    {
        $data['getRecord'] = SubjectModel::getSingle($id);

        if (!empty($data['getRecord'])) {
            $data['header_title'] = 'Edit Class';
            return view('Admin.admin.classlist.editClass', $data);
        } else {
            abort(404);
        }
    }

    public function update($id, Request $request)
    {
        $save = SubjectModel::getSingle($id);
        $save->name = $request->name;
        $save->status = $request->status;
        $save->save();

        return redirect('admin/subject/list')->with('success', 'Subject Successfully Updated');

    }

    public function delete($id)
    {
        $save = SubjectModel::getSingle($id);
        $save->is_delete = 1;
        $save->save();


        return redirect()->back()->with('success', 'Subject Successfully Deleted');

    }


}