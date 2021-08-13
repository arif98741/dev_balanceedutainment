<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EmailTemplate extends Model
{
    public $table = 'email_templates';
    
    public function template($uid, $cid) {
        DB::enableQueryLog();
        $result =  DB::table($this->table)->select('*')->where('user_id',$uid)->where('campaign_id',$cid)->first();
//        dd(dd(DB::getQueryLog()));
    return $result;
    }
}
