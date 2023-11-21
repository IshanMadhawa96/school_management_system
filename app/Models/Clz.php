<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class Clz extends Model
{
    use HasFactory;

    static public function getRecord(){
        $return = Clz::select('clzs.*','users.name as created_by_name')
                       ->join('users','users.id','clzs.created_by');
                     if(!empty(Request::get('name'))){
                        $return = $return->where('clzs.name','like','%' . Request::get('name').'%');
                     }
                     if(!empty(Request::get('date'))){
                        $return = $return->whereDate('clzs.created_at','=',Request::get('date'));
                     }
                     $return =  $return->where('clzs.is_delete','=',0)
                       ->orderBy('clzs.id','desc')
                       ->paginate(10);
        return $return;
    }

    static public function getSingle($id){
        return Clz::find($id);
    }

    static public function getClass(){
        $return = Clz::select('clzs.*')
                        ->join('users','users.id','clzs.created_by')
                        ->where('clzs.is_delete','=',0)
                        ->where('clzs.status','=',0)
                        ->orderBy('clzs.name','asc')
                        ->get();
        return $return;
    }
}
