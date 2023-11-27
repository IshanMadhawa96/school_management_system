<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;
class ClassSubject extends Model
{
    use HasFactory;

    static public function getRecord(){
        $return = ClassSubject::select('class_subjects.*','clzs.name','subjects.name as subject_name','users.name as created_by_name')
                             ->join('subjects', 'subjects.id', '=', 'class_subjects.subject_id')
                             ->join('clzs', 'clzs.id', '=', 'class_subjects.class_id')
                             ->join('users', 'users.id', '=', 'class_subjects.created_by')
                             ->where('class_subjects.is_delete', '=',0);
                             if(!empty(Request::get('class_name'))){
                                $return = $return->where('clzs.name','like','%' . Request::get('class_name').'%');
                             }
                             if(!empty(Request::get('subject_name'))){
                                $return = $return->where('subjects.name','like','%' . Request::get('subject_name').'%');
                             }
                             if(!empty(Request::get('date'))){
                                $return = $return->whereDate('class_subjects.created_at','=',Request::get('date'));
                             }
                    $return = $return->orderBy('class_subjects.id','desc')
                                ->paginate(10);
        return $return;

    }

    static public function getAlreadyFirst($class_id,$subject_id){
        return ClassSubject::where('class_id','=',$class_id)->where('subject_id','=',$subject_id)->first();
    }

    static public function getSingle($id){
        return ClassSubject::find($id);
    }

    static public function getAssignSubjectID($class_id){
        return ClassSubject::where('class_id','=',$class_id)->where('is_delete','=',0)->get();
    }

    static public function deleteSubject($class_id){
        return ClassSubject::where('class_id','=',$class_id)->where('is_delete','=',0)->delete();
    }
}

