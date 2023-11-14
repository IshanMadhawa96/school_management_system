<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clz extends Model
{
    use HasFactory;

    static public function getRecord(){
        $return = Clz::select('clzs.*','users.name as created_by_name')
                       ->join('users','users.id','clzs.created_by')
                       ->orderBy('clzs.id','desc')
                       ->paginate(10);
        return $return;
    }
}
