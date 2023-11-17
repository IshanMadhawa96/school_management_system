<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Clz;

class ClassController extends Controller
{
    public function list(){
        $data['getRecord'] =Clz::getRecord();
        $data['header_title'] = "Class List";
        return view('admin.class.list',$data);
    }

    public function add(){
        $data['header_title'] = "Add New Class";
        return view('admin.class.add',$data);
    }

    public function insert(Request $request){
        $save = new Clz;
        $save->name = $request->name;
        $save->status = $request->status;
        $save->created_by = Auth::user()->id;
        $save->save();
        return redirect('admin/class/list')->with('success',"Class successfully created!");
    }

    public function edit($id){
        $data['getRecord'] = Clz::getSingle($id);
        if(!empty($data['getRecord'])){
            $data['header_title'] = "Edit Class Information";
            return view('admin.class.edit',$data);
        }
        else{
            abort(404);
        }

    }

    public function update($id,Request $request){
        $save = Clz::getSingle($id);
        $save->name = $request->name;
        $save->status = $request->status;
        $save->save();
        return redirect('admin/class/list')->with('success',"Class successfully updated!");
    }

    public function delete($id){
        $save = Clz::getSingle($id);
        $save->is_delete =1;
        $save->save();
        return redirect()->back()->with('success',"Class successfully deleted!");
    }
}
