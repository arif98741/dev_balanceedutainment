<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Campaign extends Model {

    public $table = "campaign";

    //
    public function user_profile() {
        return $this->hasOne('users');
    }

    public function emails_report() {
        DB::enableQueryLog();
//          $result =  DB::select(DB::raw('COUNT(*) AS emails_sent'))
          $report =  DB::table('campaign_emails AS ce')->select('ce.user_id','ce.campaign_id','cu.name AS user_name','c.campaign_title',DB::raw('COUNT(*) AS emails_sent'),DB::raw('SUM(email_sent) AS sentEmail'))
                  ->leftJoin('email_templates AS et', function($join) {
                    $join->on('ce.campaign_id', '=', 'et.campaign_id');
                    $join->on('ce.user_id', '=', "et.user_id");
                })->leftJoin('cms_users AS cu','cu.id','=','ce.user_id')
                  ->leftJoin('campaign AS c','c.id','=','ce.campaign_id')
                  ->groupBy('ce.user_id','ce.campaign_id')->get();

        return $report;
   
    }

    public function user_report($userId, $cid) {
        DB::enableQueryLog();
        
          $report =  DB::table('campaign_emails AS ce')->select('*')
                  ->where('ce.campaign_id',$cid)
                  ->where('ce.user_id',$userId)->get();

        return $report;
   
    }

    public function campaigns_report() {


        $result = DB::select("SELECT 
                          c.id,c.`campaign_title`,COUNT(cc.`campaign_id`) 'clickthrough',emails.emails_sent,emails.senders,COUNT(cc.`campaign_id`)/emails.emails_sent 'ctr'
                        FROM
                          `campaign` c 
                          LEFT JOIN `campaign_clickthrough` cc ON cc.`campaign_id` = c.`id` 
                          LEFT JOIN ( SELECT  ce.`campaign_id`,COUNT(ce.`campaign_id`) 'emails_sent',COUNT(DISTINCT ce.`user_id`) 'senders' FROM `campaign_emails` ce JOIN campaign c ON ce.`campaign_id` = c.`id` GROUP BY c.`id`) emails ON emails.campaign_id = c.`id`
                        GROUP BY c.`id`");
        return $result;
    }

    public function campaign_report($campaign_id) {

        $result = DB::select("SELECT 
                        c.id,c.`campaign_title`,ce.`user_id`,cu.name,cu.`email`,
                        COUNT(ce.id) 'emails_sent'
                        FROM
                          `campaign_emails` ce 
                          LEFT JOIN cms_users cu ON cu.`id` = ce.`user_id`
                          LEFT JOIN `campaign` c ON c.`id` = ce.`campaign_id`
                        WHERE ce.`campaign_id` = ?
                        AND ce.user_id IS NOT NULL
                        GROUP BY ce.`user_id`
                        ORDER BY ce.`user_id` ASC", [$campaign_id]);
//        dd($result);
        return $result;
    }

    public static function campaign_user_report($campaign_id, $user_id) {

        $result['email_sent'] = DB::select("SELECT COUNT(*) 'emails_sent' FROM `campaign_emails` ce WHERE ce.`user_id` = $user_id AND ce.`campaign_id` = $campaign_id");
        $result['clickthrough'] = DB::select("SELECT COUNT(*) 'clickthrough'  FROM `campaign_clickthrough` cc WHERE cc.`campaign_id` = $campaign_id AND cc.`user_id`= $user_id");
    
        return $result;
    }

    public static function clickthrough_report($data= array()) {
//dd($data);
        $cid = $data['campaign_id'];
        $uid = $data['user_id'];
        $q = "SELECT ce.`email`, ce.`created_at` AS 'email_date' ,cc.*
              FROM `campaign_emails` ce 
              LEFT JOIN `campaign_clickthrough` cc ON cc.`email_id` = ce.`id` 
              WHERE ce.`campaign_id` = $cid";
        if($data['user_id'])
            $q .= " AND ce.user_id = $uid";
        
        return DB::select($q);
    }

    public static function clickthrough_user_report($campaign_id, $user_id) {

        return DB::select("SELECT 
                            ce.`email`, ce.`created_at` AS 'email_date' ,cc.*
                          FROM
                            `campaign_emails` ce 
                           LEFT JOIN `campaign_clickthrough` cc ON cc.`email_id` = ce.`id` WHERE ce.`campaign_id` = $campaign_id AND ce.user_id= $user_id");
    }

}
