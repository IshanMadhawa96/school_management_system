<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\ClassSubject;
use App\Models\Clz;
use App\Models\Subject;

class ClassSubjectController extends Controller
{
    public function list(){
        $data['getRecord'] =ClassSubject::getRecord();
        $data['header_title'] = "Subject Assign List";
        return view('admin.assign_subject.list',$data);
    }

    public function add(){
        $data['getClass'] = Clz::getClass();
        $data['getSubject'] = Subject::getSubject();
        $data['header_title'] = "Assign Subject Add";
        return view('admin.assign_subject.add',$data);
    }

    public function insert(Request $request){
        if(!empty($request->subject_id)){
            foreach($request->subject_id as $subject_id){

                $getAlreadyFirst = ClassSubject::getAlreadyFirst($request->class_id,$subject_id);
                if(!empty($getAlreadyFirst)){
                    $getAlreadyFirst->status = $request->status;
                    $getAlreadyFirst->save();
                }
                else{

                    $save = new ClassSubject;
                    $save->class_id = $request->class_id;
                    $save->subject_id = $subject_id;
                    $save->status = $request->status;
                    $save->created_by = Auth::user()->id;
                    $save->save();
                }
            }
            return redirect('admin/assign_subject/list')->with('success',"Subject Successfully Assign");
        }
        else{
            return redirect()->back()->with('error','Due to some error please try again!');
        }
    }

    public function delete($id){
        $save = ClassSubject::getSingle($id);
        $save->is_delete = 1 ;
        $save->save();
        return redirect()->back()->with('success',"Class successfully deleted!");
    }

    public function edit($id,Request $request){

        $getRecord = ClassSubject::getSingle($id);
        if(!empty($getRecord)){
            $data['getAssignSubjectID'] = ClassSubject::getAssignSubjectID($getRecord->class_id);
            $data['getClass'] = Clz::getClass();
            $data['getSubject'] = Subject::getSubject();
            $data['header_title'] = "Edit Subject Assign List";
            return view('admin.assign_subject.edit',$data);
        }
        else{
            abort(404);
        }

    }

}
