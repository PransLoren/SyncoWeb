<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManagerApiContoller extends Controller
{
    public function managerlist(){
        $admins = User::where('user_type', 1)-> where('is_delete',0)->get();
        return response()->json([
            'admins' => $admins
        ],200);
    }


    public function add (Request $request){
        $request->validate([
            'name' =>'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        $user = new User;
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->password = Hash::make($request->password);
        $user->user_type = 1;
        $user->is_delete = 0;
        $user->save();


        return response()->json(['message' => 'Admin Successfully Created'],200);

    }

    public function edit($id){
        $admin = User::find($id);

        if(!$admin || $admin->user_type !== 1 || $admin->is_delete){
            return response()->json(['error' => 'Admin Not Found'], 404);
        }
        

        return response()->json(['admin' => $admin],200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'sometimes|email|unique:users,email,' . $id,
            'password' => 'sometimes|string|min:6',
        ]);
    
        $user = User::find($id);
        if (!$user || $user->user_type !== 1 || $user->is_delete) {
            return response()->json(['error' => 'Admin not found'], 404);
        }
    
        if ($request->has('name')) {
            $user->name = trim($request->name);
        }
    
        if ($request->has('email')) {
            $user->email = trim($request->email);
        }
    
        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }
    
        $user->save();
    
        return response()->json(['message' => 'Admin successfully updated'], 200);
    }
    
    public function delete($id){


        $user = User::find($id);

        if(!$user || $user->user_type !==1 || $user->is_delete){
            return response()->json(['error' => 'Admin not found'],404);
        }

        $user->is_delete = 1;
        $user->save();


        return response()->json(['message' => 'Admin successfully deleted'], 200);
    }
}
