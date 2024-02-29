<?php

namespace App\Http\Controllers;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function managerlist(){
        $data['getRecord'] = User::getAdmin();
        $data['header_title'] = "Admin List";
        return view('Manager.manager.managerlist',$data);
    }
    public function add(){
        $data['header_title'] = "Add New Admin ";
        return view('Manager.manager.add',$data);
    }

    public function insert(Request $request){


        request()->validate([
            'email' => 'required|email|unique:users',

        ]);

        $user= new User;
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->password = Hash::make($request->password);
        $user->user_type=1;
        $user->is_delete=0;
        $user->save();

        return redirect('manager/manager/list')->with('success', 'Admin successfully created');
    }

    public function edit($id){

        $data['getRecord'] = User::getSingle($id);
        if(!empty($data['getRecord'])){
            $data['header_title'] = "Edit Admin";
            return view('Manager.manager.edit',$data);
        }
        else{
            abort(404);
        }
    }

    public function update($id,Request $request){
        
        request()->validate([
            'email' => 'required|email|unique:users,email,'.$id

        ]);

        $user= User::getSingle($id);
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        if(!empty($request->password)){
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect('manager/manager/list')->with('success', 'Admin successfully updated');
    }

    public function delete($id){
        $user = User::getSingle($id);
        $user->is_delete = 1;
        $user->save();

        return redirect('manager/manager/list')->with('success', 'Admin successfully updated');

    }
}
