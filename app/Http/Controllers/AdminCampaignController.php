<?php

namespace App\Http\Controllers;

use Session;
use Request;
use DB;
use CRUDBooster;
use App\Campaign;
use App\CampaignEmails;
use App\EmailTemplate;
//use App\Screen;

class AdminCampaignController extends \crocodicstudio\crudbooster\controllers\CBController {

public function screen(){
  //dd($_GET['data']);
  $user = DB::table('campaign_screen')->where('id', $_GET['data'])->first();
  if($user){
    return json_encode($user);
  }else{
    return json_encode(['campaign_screen'=>'']);
  }
}
    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "campaign_title";
			$this->limit = "20";
			$this->orderby = "id,desc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_bulk_action = true;
			$this->button_action_style = "button_icon";
			$this->button_add = true;
			$this->button_edit = true;
			$this->button_delete = true;
			$this->button_detail = true;
			$this->button_show = true;
			$this->button_filter = true;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "campaign";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"User","name"=>"user_id","join"=>"cms_users,name"];
			$this->col[] = ["label"=>"Campaign Title","name"=>"campaign_title"];
			$this->col[] = ["label"=>"Campaign Desc","name"=>"campaign_desc"];
			$this->col[] = ["label"=>"Campaign Status","name"=>"campaign_status"];
			$this->col[] = ["label"=>"Campaign Start_time","name"=>"campaign_start_time"];
			$this->col[] = ["label"=>"Campaign Link","name"=>"id"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'User','name'=>'user_id','type'=>'select2','validation'=>'required','width'=>'col-sm-10','datatable'=>'cms_users,name'];
			$this->form[] = ['label'=>'Campaign','name'=>'campaign_title','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10','value'=>'Title Name'];
			$this->form[] = ['label'=>'Campaign Desc','name'=>'campaign_desc','type'=>'wysiwyg','validation'=>'required|string|min:5|max:5000','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Campaign Start Time','name'=>'campaign_start_time','type'=>'datetime','validation'=>'required','width'=>'col-sm-9'];
			$this->form[] = ['label'=>'Campaign Status','name'=>'campaign_status','type'=>'select2','validation'=>'required','width'=>'col-sm-10','dataenum'=>'0|Unpublish;1|Publish;'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ['label'=>'User','name'=>'user_id','type'=>'select2','validation'=>'required','width'=>'col-sm-10','datatable'=>'cms_users,name'];
			//$this->form[] = ['label'=>'Campaign Title','name'=>'campaign_title','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10','value'=>'Title Name'];
			//$this->form[] = ['label'=>'Campaign Desc','name'=>'campaign_desc','type'=>'wysiwyg','validation'=>'required|string|min:5|max:5000','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Campaign Start Time','name'=>'campaign_start_time','type'=>'datetime','validation'=>'required','width'=>'col-sm-9'];
			//$this->form[] = ['label'=>'Campaign Status','name'=>'campaign_status','type'=>'select2','validation'=>'required','width'=>'col-sm-10','dataenum'=>'0|Unpublish;1|Publish;'];
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
        $this->addaction = array();


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
        //Your code here
//                print_r($query);
    }

    /*
      | ----------------------------------------------------------------------
      | Hook for manipulate row of index table html
      | ----------------------------------------------------------------------
      |
     */

    public function hook_row_index($column_index, &$column_value) {
      
//                echo $column_value;
      if ($column_index == '4') {
             if($column_value == 0)
                $column_value = 'UnPublished';
            else{
                $column_value = "Published";
            }
        }
        if ($column_index == '3') {
            if (strlen($column_value) > 50)
                $column_value = substr($column_value, 0, 50) . '...';
        }
        if ($column_index == '6') {
            $email = \App\CmsUsers::where('id',Session::get('admin_id'))->pluck('email')->first();
            $dataArr = array('campaign_id' => $column_value, 'user_id' => Session::get('admin_id'), 'email' => $email);
                $dataArrEncoded = base64_encode(json_encode($dataArr));
                $campaignLink = 'getStart/' . $dataArrEncoded;
                $link .= '<P><a target="_blank" href="' . url($campaignLink) . '">Campaign Link</a></p>';
            $column_value = $link;
        }
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

    //By the way, you can still create your own method in here... :) 

    public function show_campaign($post) {
      exit;
        $encodedData = json_decode(base64_decode($post), 1);
        $campaign_id = $encodedData['campaign_id'];
//        visits increment by 1
        $campaign = Campaign::find($campaign_id);
        $campaign->visits += 1;
        Campaign::where('id', $campaign_id)->update(['visits' => $campaign->visits]);
//        insert in campaign_clickthrough
        $data = array(
            'campaign_id' => $encodedData['campaign_id'],
            'user_id' => $encodedData['user_id'],
            'email_id' => $encodedData['insertId']
        );
        DB::table('campaign_clickthrough')->insert($data);
        
        CampaignEmails::whereId($encodedData['insertId'])->update(['email_read' => '1']);
        
        $data['campaign'] = $campaign;
        $data['emails'] = array();

        return view('campaign/show', $data);
    }

    public function emails_report(Campaign $campaignModel) {

        $data = $campaignModel->emails_report();
//dd($data);
        $this->cbView('campaign/emails-report', ['data' => $data]);
    }

    public function user_report(Campaign $campaignModel,Request $request, EmailTemplate $emailTemplateModel) {

        $userId = request()->userId;
        $cid = request()->cid;
        $emailTemplateData = $emailTemplateModel->template($userId , $cid);

        $data = $campaignModel->user_report($userId , $cid);
        
        $this->cbView('campaign/user-report', ['data' => $data,'template'=>$emailTemplateData]);
    }

    public function campaigns_report(Campaign $campaignModel) {

     
        $data = $campaignModel->campaigns_report();

        $this->cbView('campaign/campaigns-report', ['data' => $data]);
    }

    public  function campaign_report($id) {

        $campaignModel = new Campaign;
        $campaignData = $campaignModel->whereId($id)->first();
        $data = $campaignModel->campaign_report($id);

        $this->cbView('campaign/campaign-report', ['data' => $data, 'campaign' => $campaignData]);
    }

    public  function clickthrough_report($id) {

        $campaignModel = new Campaign;
        $campaignData = $campaignModel->select(['campaign.*','cu.name','cu.email'])->join('cms_users AS cu','cu.id','=','campaign.user_id')->where(['campaign.id'=>$id])->first();
//    dd($campaignData);
        $data = $campaignModel->clickthrough_report(array('campaign_id'=>$id));

        $this->cbView('campaign/clickthrough-report', ['data' => $data, 'campaign' => $campaignData]);
    }

    public  function clickthrough_user_report(Request $request) {
//echo request()->user_id;exit;
        $campaign_id = request()->campaign_id;
        $user_id = request()->user_id;
        $campaignModel = new Campaign;
        $campaignData = $campaignModel->select(['campaign.*','cu.name','cu.email'])->join('cms_users AS cu','cu.id','=','campaign.user_id')->where(['campaign.id'=>$campaign_id])->where(['campaign.user_id'=>$user_id])->first();
//    dd($campaignData);
        $data = $campaignModel->clickthrough_report(array('campaign_id'=>$campaign_id,'user_id'=>$user_id));

        $this->cbView('campaign/clickthrough-report', ['data' => $data, 'campaign' => $campaignData]);
    }

}