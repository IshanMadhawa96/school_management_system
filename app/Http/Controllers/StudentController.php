<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Clz;

use Hash;
use Auth;
use Str;

class StudentController extends Controller
{
    public function list(){
        $data['getRecord'] = User::getStudent();
        $data['header_title'] = "Student List";
        return view('admin.student.list',$data);
    }

    public function add(){
        $data['getClass'] = Clz::getClass();
        $data['header_title'] = "Add new Student";
        return view('admin.student.add',$data);
    }

    public function insert(Request $request){
        $student = new User;
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->admission_number = trim($request->admission_number);
        $student->roll_number = trim($request->roll_number);
        $student->class_id = trim($request->class_id);
        $student->gender = trim($request->gender);

        if(!empty($request->date_of_birth)){
            $student->date_of_birth = trim($request->date_of_birth);
        }

        if(!empty($request->file('profile_pic'))){
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = Str::random(20);
            $fileName = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/', $fileName);
            $student->profile_pic =  $fileName;

        }

        $student->caste = trim($request->caste);
        $student->religion = trim($request->religion);
        $student->mobile_number = trim($request->mobile_number);

        if(!empty($request->admission_date)){
            $student->admission_date = trim($request->admission_date);
        }

        $student->gender = trim($request->gender);

        $student->blood_group = trim($request->blood_group);
        $student->weight = trim($request->weight);
        $student->height = trim($request->height);
        $student->status = trim($request->status);
        $student->email = trim($request->email);
        $student->password = Hash::make($request->password);
        $student->user_type = 3;
        $student->save();
        return redirect('admin/student/list')->with('success',"Student created successfully");
    }
}