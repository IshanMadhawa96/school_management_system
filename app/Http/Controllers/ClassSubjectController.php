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
}
