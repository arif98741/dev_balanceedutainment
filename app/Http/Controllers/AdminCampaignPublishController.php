<?php

namespace App\Http\Controllers;

use Session;
use Request;
use DB;
use CRUDBooster;
use App\Campaign;
use App\CampaignPublish;
use App\Users;
use App\CampaignEmails;
use Mail;
use App\EmailTemplate;
use Auth;
use Illuminate\Support\Facades\Input;
use App\Mail\sendgridEmail;

class AdminCampaignPublishController extends \crocodicstudio\crudbooster\controllers\CBController {

    public function cbInit() {

        # START CONFIGURATION DO NOT REMOVE THIS LINE
        $this->title_field = "id";
        $this->limit = "20";
        $this->orderby = "id,desc";
        $this->global_privilege = false;
        $this->button_table_action = true;
        $this->button_bulk_action = true;
        $this->button_action_style = "button_icon";
        $this->button_add = false;
        $this->button_edit = false;
        $this->button_delete = false;
        $this->button_detail = false;
        $this->button_show = true;
        $this->button_filter = true;
        $this->button_import = false;
        $this->button_export = false;
        $this->table = "campaign";
        # END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Campaign","name"=>"campaign_title"];
			$this->col[] = ["label"=>"Created By","name"=>"user_id","join"=>"cms_users,name"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Campaign','name'=>'campaign_title','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-3'];
			$this->form[] = ['label'=>'Social Media Users','name'=>'users','type'=>'checkbox','validation'=>'required','width'=>'col-sm-9','datatable'=>'social_media_users,email','datatable_where'=>'user_id =1'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ['label' => 'Campaign', 'name' => 'campaign_title', 'type' => 'select2', 'validation' => 'required|integer|min:0', 'width' => 'col-sm-3'];
			//$this->form[] = ['label' => 'Social Media Users', 'name' => 'users', 'type' => 'checkbox', 'validation' => 'required', 'width' => 'col-sm-9', 'datatable' => 'social_media_users,email', 'datatable_where' => 'user_id =1'];
			# OLD END FORM

			/*
          | ----------------------------------------------------------------------
          | Sub Module
          | ----------------------------------------------------------------------
          | @label          = Label of action
          | @path           = Path of sub module
          | @foreign_key 	  = foreign key of sub table/module
          | @button_color   = Bootstrap Class (primary,success,warning,danger)
          | @button_icon    = Font Awesome Class
          | @parent_columns = Sparate with comma, e.g : name,created_at
          |
         */
        $this->sub_module = array();


        /*
          | ----------------------------------------------------------------------
          | Add More Action Button / Menu
          | ----------------------------------------------------------------------
          | @label       = Label of action
          | @url         = Target URL, you can use field alias. e.g : [id], [name], [title], etc
          | @icon        = Font awesome class icon. e.g : fa fa-bars
          | @color 	   = Default is primary. (primary, warning, succecss, info)
          | @showIf 	   = If condition when action show. Use field alias. e.g : [id] == 1
          |
         */
        $this->addaction[] = ['label' => 'Publish Campaign', 'title' => 'Publish Campaign', 'icon' => 'fa fa-money', 'color' => 'warning', 'url' => url('/publish/[id]'), 'showIf' => '[campaign_status] == "0"'];


        /*
          | ----------------------------------------------------------------------
          | Add More Button Selected
          | ----------------------------------------------------------------------
          | @label       = Label of action
          | @icon 	   = Icon from fontawesome
          | @name 	   = Name of button
          | Then about the action, you should code at actionButtonSelected method
          |
         */
        $this->button_selected = array();


        /*
          | ----------------------------------------------------------------------
          | Add alert message to this module at overheader
          | ----------------------------------------------------------------------
          | @message = Text of message
          | @type    = warning,success,danger,info
          |
         */
        $this->alert = array();



        /*
          | ----------------------------------------------------------------------
          | Add more button to header button
          | ----------------------------------------------------------------------
          | @label = Name of button
          | @url   = URL Target
          | @icon  = Icon from Awesome.
          |
         */
        $this->index_button = array();



        /*
          | ----------------------------------------------------------------------
          | Customize Table Row Color
          | ----------------------------------------------------------------------
          | @condition = If condition. You may use field alias. E.g : [id] == 1
          | @color = Default is none. You can use bootstrap success,info,warning,danger,primary.
          |
         */
        $this->table_row_color = array();


        /*
          | ----------------------------------------------------------------------
          | You may use this bellow array to add statistic at dashboard
          | ----------------------------------------------------------------------
          | @label, @count, @icon, @color
          |
         */
        $this->index_statistic = array();



        /*
          | ----------------------------------------------------------------------
          | Add javascript at body
          | ----------------------------------------------------------------------
          | javascript code in the variable
          | $this->script_js = "function() { ... }";
          |
         */
        $this->script_js = NULL;


        /*
          | ----------------------------------------------------------------------
          | Include HTML Code before index table
          | ----------------------------------------------------------------------
          | html code to display it before index table
          | $this->pre_index_html = "<p>test</p>";
          |
         */
        $this->pre_index_html = null;



        /*
          | ----------------------------------------------------------------------
          | Include HTML Code after index table
          | ----------------------------------------------------------------------
          | html code to display it after index table
          | $this->post_index_html = "<p>test</p>";
          |
         */
        $this->post_index_html = null;



        /*
          | ----------------------------------------------------------------------
          | Include Javascript File
          | ----------------------------------------------------------------------
          | URL of your javascript each array
          | $this->load_js[] = asset("myfile.js");
          |
         */
        $this->load_js = array();



        /*
          | ----------------------------------------------------------------------
          | Add css style at body
          | ----------------------------------------------------------------------
          | css code in the variable
          | $this->style_css = ".style{....}";
          |
         */
        $this->style_css = NULL;



        /*
          | ----------------------------------------------------------------------
          | Include css File
          | ----------------------------------------------------------------------
          | URL of your css each array
          | $this->load_css[] = asset("myfile.css");
          |
         */
        $this->load_css = array();
    }

    /*
      | ----------------------------------------------------------------------
      | Hook for button selected
      | ----------------------------------------------------------------------
      | @id_selected = the id selected
      | @button_name = the name of button
      |
     */

    public function actionButtonSelected($id_selected, $button_name) {

        //Your code here
    }

    /*
      | ----------------------------------------------------------------------
      | Hook for manipulate query of index result
      | ----------------------------------------------------------------------
      | @query = current sql query
      |
     */

    public function hook_query_index(&$query) {
        $query->select(['campaign.id', 'campaign_status'])->get();
//        dd($query);exit;
        //Your code here
    }

    /*
      | ----------------------------------------------------------------------
      | Hook for manipulate row of index table html
      | ----------------------------------------------------------------------
      |
     */

    public function hook_row_index($column_index, &$column_value) {
        //Your code here
    }

    /*
      | ----------------------------------------------------------------------
      | Hook for manipulate data input before add data is execute
      | ----------------------------------------------------------------------
      | @arr
      |
     */

    public function hook_before_add(&$postdata) {
//        print_r($postdata);exit;
//        $publish = new CampaignPublish;
//        foreach ($postdata['user_id'] as $id) {
//            $publish->campaign_id = $postdata['campaign_id'];
//            $publish->user_id = $id;
//            $publish->save();
//        }
        //Your code here
    }

    /*
      | ----------------------------------------------------------------------
      | Hook for execute command after add public static function called
      | ----------------------------------------------------------------------
      | @id = last insert id
      |
     */

    public function hook_after_add($id) {
        //Your code here
    }

    /*
      | ----------------------------------------------------------------------
      | Hook for manipulate data input before update data is execute
      | ----------------------------------------------------------------------
      | @postdata = input post data
      | @id       = current id
      |
     */

    public function hook_before_edit(&$postdata, $id) {
        //Your code here
    }

    /*
      | ----------------------------------------------------------------------
      | Hook for execute command after edit public static function called
      | ----------------------------------------------------------------------
      | @id       = current id
      |
     */

    public function hook_after_edit($id) {
        //Your code here 
    }

    /*
      | ----------------------------------------------------------------------
      | Hook for execute command before delete public static function called
      | ----------------------------------------------------------------------
      | @id       = current id
      |
     */

    public function hook_before_delete($id) {
        //Your code here
    }

    /*
      | ----------------------------------------------------------------------
      | Hook for execute command after delete public static function called
      | ----------------------------------------------------------------------
      | @id       = current id
      |
     */

    public function hook_after_delete($id) {
        //Your code here
    }

    public function schedule_publish_daily() {

        $campaigns = Campaign::get();

        foreach ($campaigns as $campaign) {
            if (strtotime($campaign->campaign_start_time) != time()) {
                continue;
            }
            $campaign_id = $campaign->id;

            $cpData = CampaignPublish::where('campaign_id', $campaign_id)->get();

            $users = explode(';', $cpData[0]->users);

            $emails = "'" . implode("','", $users) . "'";

            $EmailTemplate = EmailTemplate::where('campaign_id', $campaign_id)->first();

            $subject = $campaign->campaign_title;
            $body = $campaign->campaign_desc;
            $content = $EmailTemplate->content;
            $search = array('TITLE', 'CONTENT');
            $replace = array($subject, $body);
            $emailBody = str_replace($search, $replace, $content);

//        echo $emailBody;exit;
            foreach ($users as $email) {
                try {
                    $dataArr = array('campaign_id' => $campaign_id, 'user_id' => Session::get('admin_id'), 'email' => $email);
                    $insertId = CampaignEmails::insertGetId($dataArr);
                    $dataArr['insertId'] = $insertId;
                    $dataArrEncoded = base64_encode(json_encode($dataArr));

                    $campaignLink = 'campaign/' . $dataArrEncoded;
                    $emailBody .= '<P><a target="_blank" href="' . url($campaignLink) . '">Click here to follow the campaign</a></p>';

//                $emailBody .= '<input type="hidden" value="' . $dataArrEncoded . '"/>';
                    Mail::send('email', [], function($message) use ($emailBody, $email, $campSentTo, $campNotSentTo, $campaign_id) {
                        $message->subject('Publish Campaign');
                        $message->to($email);
                        $message->setBody($emailBody, 'text/html');
                    });
                } catch (Exception $e) {
                    
                }
            }
        }
    }

    public function publish($campaign_id) {

//      $to = "jaiprakash201019@gmail.com";


// ###########################

// $subject = "HTML email";

// $message = "<html> <head> <title>HTML email</title> </head> <body> <p>This email contains HTML Tags!</p> <table> <tr> <th>Firstname</th> <th>Lastname</th> </tr> <tr> <td>John</td> <td>Doe</td> </tr> </table> </body> </html> ";

// // Always set content-type when sending HTML email
// $headers = "MIME-Version: 1.0" . "\r\n";
// $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// // More headers
// $headers .= 'From: <support@ebunchapps.ca>';

// mail($to,$subject,$message,$headers);
###############





//  CHK IF DEFAULT EMAIL TEMPLATE EXIST
        $campaign = Campaign::where('id', $campaign_id)->first();
        $userId = $campaign['user_id'];

//        if (EmailTemplate::where('campaign_id', $campaign_id)->where('user_id', $userId)->exists()) {
//        $EmailTemplate = EmailTemplate::where('campaign_id', $campaign_id)->where('user_id', session()->get('admin_id'))->first();
//        }	
        if (!EmailTemplate::where('campaign_id', $campaign_id)->where('user_id', $userId)->exists()) {
            return redirect('admin/email_templates15')->with(['message' => 'Default email template not found, please add one first.', 'message_type' => 'warning']);
        }


        $cpData = CampaignEmails::where(['campaign_id' => $campaign_id])->where('email', '!=', '')->whereNotNull('email')->distinct('email')->select(['id', 'user_id', 'email', 'user_name', 'email_sent'])->orderBy('user_id')->get();

        if ($cpData->isEmpty()) {

            return redirect()->back()->with(['message' => 'No user found to publish this campaign.', 'message_type' => 'warning']);
        }

        $tempEmailsList = array();

        foreach ($cpData as $cp) {

//            validate email 
            if ($this->validate_email($cp->email) != 1) {
                continue;
            }
//            if user has been sent an email for current campaign
            if ($cp->email_sent == 1) {
                continue;
            }

            $email['email'] = $cp->email;
            if (in_array($email['email'], $tempEmailsList)) {  //remove duplicates
                continue;
            }
            $tempEmailsList[] = $email['email'];

            if ($cp->user_name) {
                $name = explode(' ', $cp->user_name);
                $userName = $name[0];
            } else {
                $userName = "";
            }
            $email['id'] = $cp->id;
            $email['user_id'] = $cp->user_id;
            $email['name'] = $userName;

            $emails[] = $email;
        }

//        if email list is empty
        if (empty($emails)) {

            return redirect()->back()->with(['message' => 'All users in this campaign  have already been sent an email.', 'message_type' => 'info']);
        }

        foreach ($emails as $email) {
            try {
                if (EmailTemplate::where('campaign_id', $campaign_id)->where('user_id', $email['user_id'])->exists()) {
                    $EmailTemplate = EmailTemplate::where('campaign_id', $campaign_id)->where('user_id', $email['user_id'])->first();
                } else {
                    $EmailTemplate = EmailTemplate::where('campaign_id', $campaign_id)->where('user_id', $campaign['user_id'])->first();
                }

                $unsbscribedEmail = DB::table('unsubscribed_emails')->where('email', $email['email'])->count();

                if($unsbscribedEmail>0)
                  continue;

                $userId = $EmailTemplate->user_id;

                $sender = \App\CmsUsers::where('id', $email['user_id'])->first();


                $subject = $EmailTemplate->title;
                $emailBody = $EmailTemplate->content;



//       in Subject 
                $search = array('&lt;sender_name&gt;', '<sender_name>', '&lt;friend_name&gt;', '&lt;first_name&gt;', '<friend_name>', '<first_name>');
                $userName = ($email['name']) ? $email['name'] : 'friend';
                $replace = array($sender->name, $sender->name, $userName, $userName, $userName, $userName);
                $subject = str_replace($search, $replace, $subject);

//       in email content
                $search1 = array('&lt;sender_name&gt;', '<sender_name>', '&lt;friend_name&gt;', '&lt;first_name&gt;', '<friend_name> ', '<first_name>', '. ', 'regards', 'Regards');
                $replaceWith = array($sender->name, $sender->name, $userName, $userName, $userName, $userName, '.<br/><br/>', 'regards<br/><br/>', 'Regards<br/><br/>');
                $emailContent = str_replace($search1, $replaceWith, $emailBody);

$emailAddress = trim($email['email'], '<>{}[]()\\/"",.?$#@*&^%;:=+-');

                  $to = $emailAddress;


###########################

// $subject = "HTML email";

$message = "<html> <head> <title>Promotion Email</title> </head> <body> <p>This email contains HTML Tags!</p> <table> <tr><td>".$emailContent."</td></tr> <tr><td>This message was sent to my [Facebook friends | LinkedIn contacts | Google contacts | Yahoo contacts | Email contracts]<br> If you don't want to receive these emails in the future, please <a href='http://dev.balanceedutainment.com/unsubscribed_email.php?key=".base64_encode($emailAddress)."'>press here</a>.</td></tr></table> </body> </html> ";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
//$headers .= 'From: <support@ebunchapps.ca>';
$headers .= 'From: '.$sender['email'];

mail($to,$subject,$message,$headers);
###############



                // Mail::send('email', [], function($message) use ($subject, $emailContent, $email, $sender) {

                //     $emailAddress = trim($email['email'], '<>{}[]()\\/"",.?$#@*&^%;:=+-');
                //    $message->from('support@ebunchapps.ca', $sender->name);
                //    // $message->from('info@dev.balanceedutainment.com', $sender->name);
                //     $message->sender($sender->email);
                //     $message->replyTo($sender->email, $sender->name);
                //     $message->subject($subject);
                //     $message->to($emailAddress);
                //     $message->setBody($emailContent, 'text/html');
                // });
                CampaignEmails::where('id', $email['id'])->update(['email_sent' => 1]);
            } catch (Exception $e) {

                if (count(Mail::failures()) > 0) {
                    //$message = Mail::failures();
                    //return redirect()->back()->with(['message' => implode(', ', $message), 'message_type' => 'error']);
                }
            }
        }
        try {
            $result = Campaign::where('id', $campaign_id)->update(['campaign_status' => 1]);
        } catch (Exception $e) {
            
        }
        $message = array('Publishing successful.');
        return redirect()->back()->with(['message' => implode(', ', $message), 'message_type' => 'success']);
    }

    public function sendMail(Request $req)
    {
      // print_r($_POST);
      // exit;

     
      // echo $_POST['emailId'];
      // exit;
       $subject=$_POST['emailSubject'];
       $emailContent=$_POST['emailTemplate'];
       $emailAddress=trim($_POST['emailId'], '<>{}[]()\\/"",.?$#@*&^%;:=+-');
       
      
  // Mail::send();
       $message= "<html> <head> <title>Promotion Email</title> </head> <body> <p>This email contains HTML Tags!</p> <table> <tr><td>".$emailContent."</td></tr> <tr><td>This message was sent to my [Facebook friends | LinkedIn contacts | Google contacts | Yahoo contacts | Email contracts]<br> If you don't want to receive these emails in the future, please <a href='http://dev.balanceedutainment.com/unsubscribed_email.php?key=".base64_encode($emailAddress)."'>press here</a>.</td></tr></table> </body> </html> ";

// Mail::send('email', [], function($data) use ($emailBody, $email, $campSentTo, $campNotSentTo, $campaign_id) {
//                         $data->subject('Testing');
//                         $data->to($_POST['emailId']);
//                         $data->setBody($emailContent, 'text/html');
//                     });
// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: '.$emailAddress;

     $re = mail($emailAddress,$subject,$message,$headers);
     if($re)
     {
      return 1;
     }
     else
     {
      return 2;
     }

    
      // return 1;
    }

    /**
     * Return : <p>1 if the email address is valid</p> <p>0 if it is invalid or empty</p> <p>and FALSE if
     *   there is an input error (such as passing in an array instead of a string).
     */
    public function validate_email($email) {
        $user = '[a-zA-Z0-9_\-\.\+\^!#\$%&*+\/\=\?\`\|\{\}~\']+';
        $domain = '(?:(?:[a-zA-Z0-9]|[a-zA-Z0-9][a-zA-Z0-9\-]*[a-zA-Z0-9])\.?)+';
        $ipv4 = '[0-9]{1,3}(\.[0-9]{1,3}){3}';
        $ipv6 = '[0-9a-fA-F]{1,4}(\:[0-9a-fA-F]{1,4}){7}';

        return preg_match("/^$user@($domain|(\[($ipv4|$ipv6)\]))$/", $email);
    }

    function make_links_clickable($text) {
        return preg_replace('!(((f|ht)tp(s)?://)[-a-zA-ZÐ°-Ñ?Ð?-Ð¯()0-9@:%_+.~#?&;//=]+)!i', '<a href="$1">$1</a>', $text);
    }

    public function publish_campaign(Request $request) {

        $allData = request()->all();
        $campaign_id = $allData['cid'];
//        dd($allData['emails']);exit;
//        print_r($allData['data']);exit;
        $campSentTo = '';
        $campSentTo .= '<tr><th>Campaign Sent to:</th></tr>';
        $campNotSentTo = '';
        $campNotSentTo .= '<tr><th>Campaign Not Sent to:</th></tr>';

        $campaign = Campaign::where('id', $campaign_id)->first();

        $emails = $allData['emails'];

        $EmailTemplate = EmailTemplate::where('campaign_id', $campaign_id)->first();

        $subject = $campaign->campaign_title;
        $body = $campaign->campaign_desc;
        $content = $EmailTemplate->content;
        $search = array('TITLE', 'CONTENT');
        $replace = array($subject, $body);
        $emailBody = str_replace($search, $replace, $content);

        $campaignLink = 'campaign/' . $campaign_id;
        $emailBody .= '<P><a target="_blank" href="' . url($campaignLink) . '">Click here to follow the campaign</a></p>';
//        echo $emailBody;exit;

        foreach ($emails as $email) {
            try {
                Mail::send('email', [], function($message) use ($emailBody, $email, $campSentTo, $campNotSentTo) {
                    $message->subject('Publish Campaign');
                    $message->to($email);
                    $message->setBody($emailBody, 'text/html');
                });
                $campSentTo .= '<tr><td>' . $email . '</td></tr>';
            } catch (Exception $e) {

                if (count(Mail::failures()) > 0) {
                    $campNotSentTo .= '<tr><td>' . $email . '</td></tr>';
                }
            }
        }
//        Mail::send('email', [], function ($message) use ($title, $emailBody, $emails, $campSentTo, $campNotSentTo) {
//
//            $message->subject('Publish Campaign');
////            $message->to($emails);
//            $message->setBody($emailBody, 'text/html');
//            foreach ($emails as $user) {
//                $message->to($user);
//            }
//        });
        $result = $campSentTo . $campNotSentTo;
        return response()->json($result);
    }

    public function del_email(Request $request) {

        $emid = request()->input('emid');

        $result = CampaignEmails::destroy($emid);
        return response()->json(array('response' => 1));
    }

}