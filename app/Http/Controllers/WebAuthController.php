<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\ForgotPasswordMail;
use Hash;
use Auth;
use Mail;
use Str;

class WebAuthController extends Controller
{

    public function forgotpassword(){
        return view('Auth.forgotpassword');
    }

    public function login(){
            
        if(!empty(Auth::check())){
            if(Auth::user()->user_type == 1){
                return redirect('admin/dashboard');
            }
            elseif(Auth::user()->user_type == 2){
                return redirect('teacher/dashboard');
            }
            elseif(Auth::user()->user_type == 3){
                return redirect('student/dashboard');
            }
            elseif(Auth::user()->user_type == 4){
                return redirect('manager/dashboard');
            }
        }

        return view('Auth.login');
    }
    public function Authlogin(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5|max:20'
        ]);
    
        $remember = !empty($request->remember);
    
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            if(Auth::user()->user_type == 1){
                return redirect('admin/dashboard');
            }
            elseif(Auth::user()->user_type == 2){
                return redirect('teacher/dashboard');
            }
            elseif(Auth::user()->user_type == 3){
                return redirect('student/dashboard');
            }
            elseif(Auth::user()->user_type == 4){
                return redirect('manager/dashboard');
            }
        } 
        else {
            return back()->with('fail', 'Incorrect Email or Password');
        }
    }

    public function PostForgotPassword(Request $request){

        $user = User::getEmailSingle($request->email);
        if(!empty($user)){

            $user->remember_token = Str::random(30);
            $user->save();

            Mail::to($user->email)->send(new ForgotPasswordMail($user));

            return redirect()->back()->with('success', 'Please check your email');
        }
        else{
            return redirect()->back()->with('error', 'Email not found in the System');
        }
    }

    public function reset($remember_token){

        $user = User::getTokenSingle($remember_token);

        if(!empty($user)){

            $data['user'] = $user;
            $data['token'] = $remember_token;
            return view('Auth.resetpass',$data);
        }
        else{
            abort(404);
        }

    }

    public function PostReset($token, Request $request){
        if($request->password == $request->cpassword){
            $user = User::getTokenSingle($token);
            $user->password = Hash::make($request->password);
            $user->remember_token = Str::random(30);
            $user->save();

            return redirect(url('/'))->with('success', 'Password successfully reset');
        }
        else{
            return redirect()->back()->with('error', 'Password does not match');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect(url(''));
    }
}
