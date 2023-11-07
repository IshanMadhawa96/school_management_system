<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Models\User;
class AuthController extends Controller
{
    public function login(){
        if(!empty(Auth::check())){
            return redirect('admin.dashboard');
        }
        return view('auth.login');
    }

    public function AuthLogin(Request $request){

        $remember = !empty($request->remember) ? true :false;

        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password],$remember)){

            if(Auth::user()->user_type == 1){

                return redirect('admin/dashboard');

            }
            elseif(Auth::user()->user_type == 2){
                return redirect('teacher/dashboard');
            }
            elseif(Auth::user()->user_type == 3)
            {
                //dd(Auth::user());
                return redirect('student/dashboard');
            }
            elseif(Auth::user()->user_type == 4)
            {
                return redirect('parent/dashboard');
            }
        }
        else{
            return redirect()->back()->with('error','Please enter correct email and password');
        }
    }

    public function logout(){
        Auth::logout();
        return view('auth.login');
    }

    public function forgotPassword(){
        return view('auth.forgot');
    }

    public function postForgotPassword(Request $request){
        $user = User::getEmailSingle($request->email);
        if(!empty($user)){

        }
        else{
            return redirect()->back()->with('error','Email not found in the system.');
        }
    }
}
