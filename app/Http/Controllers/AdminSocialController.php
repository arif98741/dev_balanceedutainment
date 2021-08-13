<?php

namespace App\Http\Controllers;

use Session;
//use Request;
use DB;
use Auth;
use CRUDBooster;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use JeroenDesloovere\VCard\VCard;
use JeroenDesloovere\VCard\VCardParser;
use Illuminate\Routing\Route;

use \URL;
use App\Campaign;
use App\CampaignEmails;
use App\EmailTemplate;
use App\CmsUsers;


class AdminSocialController extends \crocodicstudio\crudbooster\controllers\CBController {

    public $arr = array();
    
    
    public function __construct() {

    }
    public function cbInit() {

        # START CONFIGURATION DO NOT REMOVE THIS LINE
        $this->title_field = "";
        $this->limit = "";
        $this->orderby = "";
        $this->global_privilege = false;
        $this->button_table_action = false;
        $this->button_bulk_action = false;
        $this->button_add = false;
        $this->button_edit = false;
        $this->button_delete = false;
        $this->button_detail = false;
        $this->button_show = false;
        $this->button_filter = false;
        $this->button_import = false;
        $this->button_export = false;
        $this->table = "social_media_users";
        # END CONFIGURATION DO NOT REMOVE THIS LINE
        # START COLUMNS DO NOT REMOVE THIS LINE
        $this->col = [];

        # END COLUMNS DO NOT REMOVE THIS LINE
        # START FORM DO NOT REMOVE THIS LINE
        $this->form = [];

        # END FORM DO NOT REMOVE THIS LINE
        # OLD START FORM
        //$this->form = [];
        //$this->form[] = ["label"=>"User Id","name"=>"user_id","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"user,id"];
        //$this->form[] = ["label"=>"Campaign Title","name"=>"campaign_title","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
        //$this->form[] = ["label"=>"Campaign Desc","name"=>"campaign_desc","type"=>"textarea","required"=>TRUE,"validation"=>"required|string|min:5|max:5000"];
        //$this->form[] = ["label"=>"Campaign Start Time","name"=>"campaign_start_time","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
        //$this->form[] = ["label"=>"Campaign Status","name"=>"campaign_status","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
        //$this->form[] = ["label"=>"Visits","name"=>"visits","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
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

    /*
      | ----------------------------------------------------------------------
      | save email list
      | ----------------------------------------------------------------------
      |
     */

    public function save_social_list(Request $request) {

        $allData = $request->all();
//dd($allData['users']);
        $user_id = Session::get('admin_id');
        $posts = json_decode($allData['data']);
//        print_r($allData['data']);exit;
        $insertIt = array();
        $inserted = '<tr><th colspan="2">INSERTED IN DB</th></tr>';
        $inserted .= '<tr><th>Name</th><th>Email</th></tr>';
        $existing = '<tr><th colspan="2">ALREADY IN DB</th></tr>';
        $existing .= '<tr><th>Name</th><th>Email</th></tr>';
        foreach ($allData['users'] as $post) {
            $data = array(
                'user_id' => $user_id,
                'user_name' => $post['name'],
                'email' => $post['email'],
                'type' => $allData['type']
            );
            if (DB::table('social_media_users')->where($data)->exists()) {
                $existing .= '<tr><td>' . $post['name'] . '</td>';
                $existing .= '<td>' . $post['email'] . '</td></tr>';
            } else {
                $inserted .= '<tr><td>' . $post['name'] . '</td>';
                $inserted .= '<td>' . $post['email'] . '</td></tr>';
                $insertIt[] = $data;
            }
        }
//        dd($data);
        $inserted .= '</tr>';
        $existing .= '</tr>';
        $r = DB::table('social_media_users')->insert($insertIt);
        $result = $inserted . $existing;
        return response()->json($result);
    }

    public function getIndex() {

        if (!CRUDBooster::isView())
            CRUDBooster::redirect(CRUDBooster::adminPath(), trans('crudbooster.denied_access'));


        return $this->cbView('campaign/social-list', []);
    }

    public function getYahooContacts() {

        if (!CRUDBooster::isView())
            CRUDBooster::redirect(CRUDBooster::adminPath(), trans('crudbooster.denied_access'));

        if (request()->session()->exists('yahooContacts') && !empty(request()->session()->get('yahooContacts'))) {
            $emails['emails'] = request()->session()->get('yahooContacts');
            return $this->cbView('campaign/list-contacts', $emails);
            exit;
        }

        // get data from request
        $code = request()->get('code');

        \OAuth::setHttpClient('CurlClient');

        // get yahoo service
        $yh = \OAuth::consumer('Yahoo');

        // if code is provided get user data and sign in
        if (!is_null($code)) {
            // This was a callback request from yahoo, get the token
            $token = $yh->requestAccessToken($code);

            $xid = $token->getExtraParams();

            $result = json_decode($yh->request('https://social.yahooapis.com/v1/user/' . $xid['xoauth_yahoo_guid'] . '/contacts?format=json'), true);

            // Going through the array to clear it and create a new clean array with only the email addresses

            $emails = [];
            if ($result['contacts']['count'] > 0) {
                $list = $result['contacts']['contact'];

                foreach ($list as $i => $contact) {
                    if ($contact['categories'][0]['name'] == 'yahoo contacts') {
                        foreach ($contact['fields'] as $field) {

                            if ($field['type'] == 'email') {
                                $emails[$i]['email'] = $field['value'];
                                if (!empty($contact['fields'][0]['value']['givenName']))
                                    $emails[$i]['name'] = $contact['fields'][0]['value']['givenName'] . '&nbsp;' . $contact['fields'][0]['value']['middleName'] . '&nbsp;' . $contact['fields'][0]['value']['familyName'];
                                else
                                    $emails[$i]['name'] = '';
                            }
                        }
                    }
                }
                request()->session()->put('yahooContacts', $emails);
            }

            $data['emails'] = $emails;
            $data['type'] = 'yahoo';
            $this->cbView('campaign/list-contacts', $data);
        } // if not ask for permission first
        else {
            // get Authorization Uri sending the request token
            $url = $yh->getAuthorizationUri();

            // return to yahoo login url
            return redirect((string) $url);
        }
    }

    public function getYahooContacts2() {


        $code = request()->get('code');

        $campaignId = request()->get('i');

        \OAuth::setHttpClient('CurlClient');

        $url = URL::current() . '?i=' . $campaignId;
        $yh = \OAuth::consumer('Yahoo', $url);


        // if code is provided get user data and sign in
        if (!is_null($code)) {
            // This was a callback request from yahoo, get the token
            $token = $yh->requestAccessToken($code);

            $xid = $token->getExtraParams();

            $result = json_decode($yh->request('https://social.yahooapis.com/v1/user/' . $xid['xoauth_yahoo_guid'] . '/contacts?format=json'), true);

            // Going through the array to clear it and create a new clean array with only the email addresses

            $emails = [];
            if ($result['contacts']['count'] > 0) {
                $list = $result['contacts']['contact'];

                foreach ($list as $i => $contact) {
                    if ($contact['categories'][0]['name'] == 'yahoo contacts') {
                        foreach ($contact['fields'] as $field) {
//                   dd($field);

                            if ($field['type'] == 'email') {
//                                dd($contact['fields']);
                                $emails[$i]['email'] = $field['value'];
//                                 print_r($contact);
                                if (!empty($contact['fields'][0]['value']['givenName']))
                                    $emails[$i]['name'] = $contact['fields'][0]['value']['givenName'] . '&nbsp;' . $contact['fields'][0]['value']['middleName'] . '&nbsp;' . $contact['fields'][0]['value']['familyName'];
                                else
                                    $emails[$i]['name'] = '';
                            }
                        }
                    }
                }
            }
            $data['type'] = 'Yahoo';
//            if (isset($campaignId)) {
//                $campaign = Campaign::find($campaignId);
//
//                $data['campaign'] = $campaign;
//                $data['emails'] = $emails;
//                return view('campaign/show', $data);
//            } else {
            $campaign = Campaign::find($campaignId);

            $data['campaign'] = $campaign;
            usort($emails, function($a, $b) {
                return strcmp($a['name'], $b['name']);
            });

            $emailTemplate=EmailTemplate::where('campaign_id',request()->get('i'))
                                ->orderBy('id', 'desc')
                                ->first();
            if(empty($emailTemplate->toArray()))
            {
              $data['emailTemplate']=[];
            }
            else
            {
              $data['emailTemplate']=$emailTemplate;
            }


            $data['emails'] = $emails;
            return view('system/show', $data);
//            }
        } // if not ask for permission first
        else {
            // get Authorization Uri sending the request token
            $url = $yh->getAuthorizationUri();

            // return to yahoo login url
            return redirect((string) $url);
        }
    }

    public function getGoogleContacts() {

        if (!CRUDBooster::isView())
        {

            CRUDBooster::redirect(CRUDBooster::adminPath(), trans('crudbooster.denied_access'));
        }

        if (request()->session()->exists('googleContacts')) {

            $emails['emails'] = request()->session()->get('googleContacts');

            return $this->cbView('campaign/list-contacts', $emails);
            exit;
        }

        // get data from request
        $code = request()->get('code');

        // get google service
        \OAuth::setHttpClient('CurlClient');
        $googleService = \OAuth::consumer('Google');

        // check if code is valid
        // if code is provided get user data and sign in
        if (!is_null($code)) {
            // This was a callback request from google, get the token
            $token = $googleService->requestAccessToken($code);

            // Send a request with it
            $result = json_decode($googleService->request('https://www.google.com/m8/feeds/contacts/default/full?updated-min=2007-03-16T00:00:00&alt=json&max-results=10000'), true);

            // Going through the array to clear it and create a new clean array with only the email addresses
            $emails = []; // initialize the new array
            foreach ($result['feed']['entry'] as $i => $contact) {

                if (isset($contact['gd$email'])) { // Sometimes, a contact doesn't have email address
//                                dd($contact);
                    if (!empty($contact['title']['$t']))
                        $emails[$i]['name'] = $contact['title']['$t'];
                    else
                        $emails[$i]['name'] = '';
                    $emails[$i]['email'] = $contact['gd$email'][0]['address'];
                }
            }

            request()->session()->put('googleContacts', $emails);
            $data['emails'] = $emails;
            $data['type'] = 'google';
            $this->cbView('campaign/list-contacts', $data);
        }
        // if not ask for permission first
        else {
            // get googleService authorization
           // $url = $googleService->getAuthorizationUri();
            $url = $googleService->getAuthorizationUri(array('state' => ''));
            // return to google login url
            return redirect((string) $url);
        }
    }

    public function getGoogleContacts2() {


        // get data from request
        $code = request()->get('code');


        $cid = request()->get('i');
        // if(!is_null($code)){
        //   return redirect((string) $url);
        // }
        \OAuth::setHttpClient('CurlClient');
        $googleService = \OAuth::consumer('Google');

        // check if code is valid
        // if code is provided get user data and sign in
        if (!is_null($code)) {
          
            // This was a callback request from google, get the token
           
        $token = $googleService->requestAccessToken($code);
            // Send a request with it
            $result = json_decode($googleService->request('https://www.google.com/m8/feeds/contacts/default/full?updated-min=2007-03-16T00:00:00&alt=json&max-results=10000&state=1'), true);

            // Going through the array to clear it and create a new clean array with only the email addresses
            $emails = []; // initialize the new array
            foreach ($result['feed']['entry'] as $i => $contact) {

                if (isset($contact['gd$email'])) { // Sometimes, a contact doesn't have email address
//                                dd($contact);
                    if (!empty($contact['title']['$t']))
                        $emails[$i]['name'] = $contact['title']['$t'];
                    else
                        $emails[$i]['name'] = '';
                    $emails[$i]['email'] = $contact['gd$email'][0]['address'];
                }
            }

            $data['type'] = 'Google';

            $campaignId = request()->get('state');
            $data['i'] = $campaignId;
            $campaign = Campaign::find($campaignId);

            $data['campaign'] = $campaign;
            usort($emails, function($a, $b) {
                return strcmp($a['name'], $b['name']);
            });
            $data['emails'] = $emails;
            $data['type'] = 'Google';

            $emailTemplate=EmailTemplate::where('campaign_id',request()->get('state'))
                                ->orderBy('id', 'desc')
                                ->first();
            
            $con = array(
                'screen' => '7',
                'campaign_id'=>request()->input('state')
            );
            $result = DB::table('campaign_screen')->where($con)->get()->toArray();
            $titleResult = DB::table('screen_step')->where(array('id' => '7'))->get()->first();
            $data['results']  = $result;
            $data['title']  = $titleResult->name; 

            //$data['method'] = $route->getActionMethod();
            return view('system/show', $data);
//            }
        }
        // if not ask for permission first
        else {
            // get googleService authorization
            $url = $googleService->getAuthorizationUri(array('state' => $cid));

            // return to google login url
            return redirect((string) $url);
        }
    }

    public function getFacebookContacts() {
        if (!CRUDBooster::isView())
            CRUDBooster::redirect(CRUDBooster::adminPath(), trans('crudbooster.denied_access'));

        if (request()->session()->exists('facebookContacts')) {
            $emails['emails'] = request()->session()->get('facebookContacts');
            return $this->cbView('campaign/list-contacts', $emails);
            exit;
        }

        // get data from request
        $code = request()->get('code');

        \OAuth::setHttpClient('CurlClient');

        // get yahoo service
        $yh = \OAuth::consumer('Yahoo');

        // if code is provided get user data and sign in
        if (!is_null($code)) {
            // This was a callback request from yahoo, get the token
            $token = $yh->requestAccessToken($code);

            $xid = $token->getExtraParams();

            $result = json_decode($yh->request('https://social.yahooapis.com/v1/user/' . $xid['xoauth_yahoo_guid'] . '/contacts?format=json&max_limit=10'), true);

            // Going through the array to clear it and create a new clean array with only the email addresses
            $list = $result['contacts']['contact'];

            $emails = [];
            if ($result['contacts']['count'] > 0) {
                foreach ($list as $i => $contact) {

                    if ($contact['categories'][0]['name'] == 'Facebook Friends') {

                        $name = $contact['fields'][0]['value']['givenName'] . ' ' . $contact['fields'][0]['value']['middleName'] . ' ' . $contact['fields'][0]['value']['familyName'];
                        foreach ($contact['fields'] as $field) {
                            if ($field['type'] == 'email') {
                                $email = $field['value'];
                            }
                        }
                        $emails[$i]['name'] = $name;
                        $emails[$i]['email'] = $email;
                    }
                }
                request()->session()->put('facebookContacts', $emails);
            }
            $data['emails'] = $emails;
            $data['type'] = 'facebook';
            $this->cbView('campaign/list-contacts', $data);
        } // if not ask for permission first
        else {
            // get Authorization Uri sending the request token
            $url = $yh->getAuthorizationUri();

            // return to yahoo login url
            return redirect((string) $url);
        }
    }

    public function getFacebookContacts2() {



        ini_set('memory_limit', '-1');
        $code = request()->get('code');

        $campaignId = request()->get('i');

        \OAuth::setHttpClient('CurlClient');

//        \OAuth::setHttpParam('CurlClient');
        // get yahoo service
        $url = URL::current() . '?i=' . $campaignId;
        $yh = \OAuth::consumer('Yahoo', $url);

        // if code is provided get user data and sign in
        if (!is_null($code)) {
            // This was a callback request from yahoo, get the token
            $token = $yh->requestAccessToken($code);

            $xid = $token->getExtraParams();

            $result = json_decode($yh->request('https://social.yahooapis.com/v1/user/' . $xid['xoauth_yahoo_guid'] . '/contacts;start=0;count=max;?format=json&count=max'), true);

            // Going through the array to clear it and create a new clean array with only the email addresses
            $list = $result['contacts']['contact'];
//echo '<pre>';
//print_r($list);exit;
            $emails = [];
            if ($result['contacts']['count'] > 0) {

                foreach ($list as $i => $contact) {

                    if ($contact['categories'][0]['name'] == 'Facebook Friends') {

                        if ($contact['fields'][0]['value']['givenName'] == '') {
                            continue;
                        }
                        foreach ($contact['fields'] as $field) {

                            if ($field['type'] == 'email') {

                                $email = $field['value'];
                                $emails[$i]['email'] = $email;
                                if (!empty($contact['fields'][0]['value']['givenName']) || !empty($contact['fields'][0]['value']['middleName']) || !empty($contact['fields'][0]['value']['familyName']))
                                    $emails[$i]['name'] = $contact['fields'][0]['value']['givenName'] . '&nbsp;' . $contact['fields'][0]['value']['middleName'] . '&nbsp;' . $contact['fields'][0]['value']['familyName'];
                                else
                                    $emails[$i]['name'] = '';
                            }
                        }
                    }
                }
            }

            $data['type'] = 'Facebook';
//            if (isset($campaignId)) {
//                $campaign = Campaign::find($campaignId);
//
//                $data['campaign'] = $campaign;
//                $data['emails'] = $emails;
//                return view('campaign/show', $data);
//            } else {
            $campaign = Campaign::find($campaignId);

            usort($emails, function($a, $b) {
                return strcmp($a['name'], $b['name']);
            });

            $data['campaign'] = $campaign;
            $data['emails'] = $emails;
            return view('system/show', $data);
//            }
        } // if not ask for permission first
        else {
            // get Authorization Uri sending the request token
            $url = $yh->getAuthorizationUri();

            // return to yahoo login url
            return redirect((string) $url);
        }
    }

    public function linkedin2() {

        $campaignId = request()->get('i');

        $data['campaignId'] = $campaignId;
        return view('campaign/linkedin2', $data);
    }

    public function linkedin() {
        return $this->cbView('campaign/linkedin', []);
    }

    public function uploadVcard() {
        return $this->cbView('campaign/vcard-upload', []);
    }

    public function uploadVcard2() {
        $campaignId = request()->get('i');

        $data['campaignId'] = $campaignId;
        return $this->cbView('campaign/vcard-upload2', $data);
    }

    public function getLinkedinContacts2(Request $request) {


        $campaignId = request()->get('cid');

        if ($request->hasFile('csv-file')) {

            $file = $request->file('csv-file');
            $name = time() . '-' . $file->getClientOriginalName();
            // Moves file to folder on server
            $csv = $file->move(storage_path() . '\public\csv-file', $name);
        }else{
          return redirect()->back();
        }

        $filename = $csv->getPathname();

        if (!file_exists($filename) || !is_readable($filename))
            return FALSE;

        $header = NULL;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== FALSE) {
            while (($row = fgetcsv($handle, 1000, ',')) !== FALSE) {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }
        foreach ($data as $i => $record) {
            if (empty($record['Email Address'])) {
                continue;
            }
            $emails[$i]['email'] = $record['Email Address'];
            $emails[$i]['name'] = $record['First Name'] . ' ' . $record['Last Name'];
        }
        $data['type'] = 'Linkedin';
        $campaign = Campaign::find($campaignId);

        $data['campaign'] = $campaign;
        $data['i'] = $campaignId;
        usort($emails, function($a, $b) {
            return strcmp($a['name'], $b['name']);
        });
        $data['emails'] = $emails;
        $con = array(
                'screen' => '7',
                'campaign_id'=>$campaignId
            );
            $result = DB::table('campaign_screen')->where($con)->get()->toArray();
            $titleResult = DB::table('screen_step')->where(array('id' => '7'))->get()->first();
            $data['results']  = $result;
            $data['title']  = $titleResult->name;
        return view('system/show', $data);
//        }
    }

    public function getLinkedinContacts(Request $request) {


        if ($request->hasFile('csv-file')) {

            $file = $request->file('csv-file');
            $name = time() . '-' . $file->getClientOriginalName();
            // Moves file to folder on server
            $csv = $file->move(storage_path() . '\public\csv-file', $name);
        }

        $filename = $csv->getPathname();

        if (!file_exists($filename) || !is_readable($filename))
            return FALSE;

        $header = NULL;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== FALSE) {
            while (($row = fgetcsv($handle, 1000, ',')) !== FALSE) {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }
        foreach ($data as $i => $record) {
            if (empty($record['Email Address'])) {
                continue;
            }
            $emails[$i]['email'] = $record['Email Address'];
            $emails[$i]['name'] = $record['First Name'] . ' ' . $record['Last Name'];
        }
//        dd($emails);
        $data['emails'] = $emails;
        $data['type'] = 'linkedin';
        $this->cbView('campaign/list-contacts', $data);
    }

    public function processVcard(Request $request) {

        if ($request->hasFile('vcard-file')) {

            $file = $request->file('vcard-file');
            $name = time() . '-' . $file->getClientOriginalName();
            // Moves file to folder on server
            $vcard = $file->move(storage_path() . '\public\vcard-file', $name);
        }

        $filename = $vcard->getPathname();

        if (!file_exists($filename) || !is_readable($filename))
            return FALSE;

        $vcards = VCardParser::parseFromFile($filename);

        $emails = array();
        foreach ($vcards as $i => $record) {
//if($record->fullname == 'Aalam bhai'){dd($record);}
            $emails[$i]['name'] = $record->fullname;
            if (array_key_exists('email', $record)) {
                $emails[$i]['email'] = $record->email['INTERNET'][0];
            } elseif (array_key_exists('phone', $record)) {
                foreach ($record->phone as $t => $typeCell) {
                    $emails[$i]['email'] = $typeCell[0];
                }
            }
        }
        $data['emails'] = $emails;
        $data['type'] = 'vcard';
        $this->cbView('campaign/list-contacts', $data);
    }

    public function processVcard2(Request $request) {

         $campaignId = request()->get('cid');
         $emailTemplate=EmailTemplate::where('campaign_id',request()->get('cid'))
                                ->orderBy('id', 'desc')
                                ->first();
                               
            if(empty($emailTemplate->toArray()))
            {
              $data['emailTemplate']=[];
            }
            else
            {
              $data['emailTemplate']=$emailTemplate;
            } 

        if ($request->hasFile('vcard-file')) {

            $file = $request->file('vcard-file');
            $name = time() . '-' . $file->getClientOriginalName();
            // Moves file to folder on server
            $vcard = $file->move(storage_path() . '\public\vcard-file', $name);
        }else{
          return redirect()->back();
        }

        $filename = $vcard->getPathname();

        if (!file_exists($filename) || !is_readable($filename))
            return FALSE;

        $vcards = VCardParser::parseFromFile($filename);

        $emails = array();
        foreach ($vcards as $i => $record) {

            if (array_key_exists('email', $record)) {
                if (array_key_exists("INTERNET;pref", $record->email) && $record->email['INTERNET;pref'][0] != '') {
                    $emails[$i]['email'] = $record->email['INTERNET;pref'][0];
                    if ($record->firstname != '') {
                        $emails[$i]['name'] = $record->firstname . ' ' . $record->lastname;
                    }
                } else if (array_key_exists("INTERNET", $record->email) && $record->email['INTERNET'][0] != '') {
                    $emails[$i]['email'] = $record->email['INTERNET'][0];
                    if ($record->firstname != '') {
                        $emails[$i]['name'] = $record->firstname . ' ' . $record->lastname;
                    }
                }
            }/* elseif (array_key_exists('phone', $record)) {
              foreach ($record->phone as $t => $typeCell) {
              $emails[$i]['email'] = $typeCell[0];
              }
              } */
        }
        $data['type'] = 'VCard';
//        if (isset($campaignId)) {
//            $campaign = Campaign::find($campaignId);
//
//            $data['campaign'] = $campaign;
//            $data['emails'] = $emails;
//            return view('campaign/show', $data);
//        } else {
        $campaign = Campaign::find($campaignId);

        $data['campaign'] = $campaign;
        $data['i'] = $campaignId;
        usort($emails, function($a, $b) {
            return strcmp($a['name'], $b['name']);
        });
        $data['emails'] = $emails;
        $con = array(
                'screen' => '7',
                'campaign_id'=>$campaignId
            );
            $result = DB::table('campaign_screen')->where($con)->get()->toArray();
            $titleResult = DB::table('screen_step')->where(array('id' => '7'))->get()->first();
            $data['results']  = $result;
            $data['title']  = $titleResult->name;
        return view('system/show', $data);
//        }
    }

public function getStart($post) {
        // IF THERE IS ANY EMAIL LIST SAVED IN SESSION, CLEAR IT
        session()->forget('socialEmails');

        $encodedData = json_decode(base64_decode($post), 1);
        //print_r( $encodedData['campaign_id']);

        $campaign_id = $encodedData['campaign_id'];

        $user_id = $encodedData['user_id'];
        //  visits increment by 1
        $campaign = Campaign::find($campaign_id);
        $campaign->visits += 1;
        Campaign::where('id', $campaign_id)->update(['visits' => $campaign->visits]);
        //  insert in campaign_clickthrough
        if (isset($encodedData['insertId'])) { // if link is copied from admin side then it does not contain insertId
            $data = array(
                'campaign_id' => $encodedData['campaign_id'],
                'user_id' => $encodedData['user_id'],
                'email_id' => $encodedData['insertId']
            );
            DB::table('campaign_clickthrough')->insert($data);

            CampaignEmails::whereId($encodedData['insertId'])->update(['email_read' => '1']);
        }

        $emailTemplate=EmailTemplate::where('campaign_id',$campaign_id)->orderBy('id', 'desc')
                                ->first();
        $campaign=Campaign::where('id',$campaign_id)->orderBy('id', 'desc')->first();
        $CmsUsers=CmsUsers::orderBy('id', 'desc')->get();;
       

            $con = array(
                'screen' => '10',
                'campaign_id'=>$campaign_id
            );

            $result = DB::table('campaign_screen')->where($con)->get()->toArray();
            //dd($result);
            $titleResult = DB::table('screen_step')->where(array('id' => '10'))->get()->first();
            $data['results']  = $result;
            $data['i']  = $campaign_id;
            $data['title']  = $titleResult->name;
            //dd(compact($data)); 
            //$data['method'] = $route->getActionMethod();
        return view('system/get-start', compact('encodedData','data','dataNew1','campaign','post','CmsUsers'));
}

public function proceedStart() {
    $data = array();
    return view('system/proceed-start', $data);
}


 public function updateCampaign(Request $request)
 {
       $campaign = Campaign::find($request->campaign_id);
       $campaign->user_id = $request->cuser;
       $campaign->campaign_title = $request->ctitle;
       $campaign->campaign_desc = $request->cdesc;
       $campaign->campaign_start_time = $request->campaign_date;
       $campaign->campaign_status = $request->cstatus;
       if($campaign->save()){
        return 1;        
       }else{
        return 0;
       }
}
    public function updateTemplate(Request $request)
    {
      // $id=$_POST['templateId'];
      // $content=$_POST['data'];
      
      DB::table('email_templates')->where('id',$request->templateId)->update(['content'=>$request->data]);
      return 1;
    }

public function updateScreen(Request $request)
{
     $con = array(
      'id'=>$request->ScreenId,
      'campaign_id'=>$request->campaignId,
     );
    $flag = DB::table('campaign_screen')->where($con)->update(['campaign_screen'=>$request->data]);
  if($flag){
    return 1;  
  }else{
    return 0;
  }
  
}

 public function getScreen()
{

  
  $id = $_REQUEST['id'];
  $selectedScreenId = '0';
  if($id !=''){
    $campaign = DB::table('campaign_screen')->where('id', $id)->first();
    if($campaign){
      $selectedScreenId =  $campaign->screen;
    }
  }

  $response = DB::table('screen_step')->orderBy('screen_order', 'asc')->get();
  $html = "";
  $html .= "<option value='0'>--Select Screen--</option>";
  foreach ($response as $key => $value) {
    if($selectedScreenId == $value->id){
$html .= "<option value='".$value->id."' selected=''>".$value->name."</option>";
    }else{
$html .= "<option value='".$value->id."'>".$value->name."</option>";
    }
   
  }
  echo $html;
  // if($flag){
  //   return 1;  
  // }else{
  //   return 0;
  // }
  
} 

 
 public function checkScreen()
{

  $campaign_id = $_GET['campaign_id'];
  $screen      = $_GET['screen'];
  $type      = $_GET['type'];
  $id      = $_GET['id'];

  
  if($campaign_id !='' && $screen !=''){
    $records = DB::table('screen_step')->where('id',$screen)->first();
    $defaultScreen = $records->default_screen;
     $con = array(
      'campaign_id'=>$campaign_id,
      'screen'=>$screen,
     );
     $screenResult = DB::table('campaign_screen')->where($con)->first();
        if(!empty($screenResult)){
          //$defaultScreen = 'updateed';
          $defaultScreen = $screenResult->campaign_screen;
        }
 //$defaultScreen = ($screenResult->campaign_screen);
      if( $type == "edit"){ 
        $count = DB::table('campaign_screen')->where('id', '!=' , $id)->where($con)->get()->count();
      }else{
        $count = DB::table('campaign_screen')->where($con)->get()->count();
      }
    $response = array('status'=>"success",'defaultScreen'=>$defaultScreen,"count"=>$count,"message"=>"Record count");
  }else{
    $response = array('status'=>"failed",'defaultScreen'=>$defaultScreen,"message"=>"invalid Records");
  }
  echo json_encode($response);
  // if($flag){
  //   return 1;  
  // }else{
  //   return 0;
  // }
  
}   
    

    public function sendMail(Request $req)
    {
      // print_r($_POST);
      // exit;
      $subject=$req->emailSubject;
      $emailContent=$req->emailTemplate;
      $emailAddress=$req->emailId;
      $to=$req->emailId;

      $message = "<html> <head> <title>Promotion Email</title> </head> <body> <p>This email contains HTML Tags!</p> <table> <tr><td>".$emailContent."</td></tr> <tr><td>This message was sent to my [Facebook friends | LinkedIn contacts | Google contacts | Yahoo contacts | Email contracts]<br> If you don't want to receive these emails in the future, please <a href='http://dev.balanceedutainment.com/unsubscribed_email.php?key=".base64_encode($emailAddress)."'>press here</a>.</td></tr></table> </body> </html> ";


// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
//$headers .= 'From: <support@ebunchapps.ca>';
$headers .= 'From: '.$emailAddress;

echo mail($to,$subject,$message,$headers);

    }

   

    

    
    public function uploadForLinkedin() {
        $data['i'] = request()->input('i');
        return view('system/upload-for-linkedin', $data);
    }

    
    public function composeMsg() {
//dd(session()->all());
        $campaign_id = session()->get('cid');
        $user_id = session()->get('user_id');

        $userInfo = \App\CmsUsers::where('id', $user_id)->first();
        $campaignRow = Campaign::where('id', $campaign_id)->first();
        if (EmailTemplate::where(['campaign_id' => $campaign_id, 'user_id' => $user_id])->exists()) {

            $campaign = Campaign::select('campaign.*', 'et.title AS subject', 'et.content as body')->leftJoin('email_templates AS et', 'et.campaign_id', '=', 'campaign.id')->where(['campaign.id' => $campaign_id, 'et.user_id' => $user_id])->first();
        } else {

            $campaignRow = Campaign::where('id', $campaign_id)->first();

            $campaign = Campaign::select('campaign.*', 'et.title AS subject', 'et.content as body')->leftJoin('email_templates AS et', 'et.campaign_id', '=', 'campaign.id')->where(['campaign.id' => $campaign_id, 'et.user_id' => $campaignRow['user_id']])->first();
        }
//        dd($campaign);
        $search = array('&lt;sender_name&gt;', '<sender_name>');
        $replace = array($userInfo['name'], $userInfo['name']);
        $campaign['subject'] = str_replace($search, $replace, $campaign['subject']);
        // $campaign['body'] = str_replace($search, $replace, $campaign['body']);
         // dd($campaignRow);
        // $campaign['body'] = $campaignRow['campaign_desc'];

        $data['campaign'] = $campaign;
        $data['myCampagin']=$campaignRow;
        $data['i'] = $campaign_id;
         $con = array(
                'screen' => '8',
                'campaign_id'=>$campaign_id
            );
            $result = DB::table('campaign_screen')->where($con)->get()->toArray();
            $titleResult = DB::table('screen_step')->where(array('id' => '8'))->get()->first();
            $data['results']  = $result;
            $data['title']  = $titleResult->name; 
            //dd($data);
        return view('system/compose-msg', $data);
    }

    public function saveMsg(Request $request) {

        $campaign_id = session()->get('cid');
        $emails = session()->get('socialEmails');
        
        $user_id = session()->get('user_id');
        // dd($emails);
        $campaign = Campaign::where('id', $campaign_id)->first();


        if (EmailTemplate::where(['campaign_id' => $campaign_id, 'user_id' => $user_id])->exists()) {

            $tempalteData = array(
                'title' => $request->input('subject'),
                'content' => $request->input('msg-desc')
            );
            EmailTemplate::where(['campaign_id' => $campaign_id, 'user_id' => $user_id])->update($tempalteData);
        } else {

            $tempalteData = array(
                'campaign_id' => $campaign_id,
                'user_id' => session()->get('user_id'),
                'title' => $request->input('subject'),
                'content' => $request->input('msg-desc')
            );
            EmailTemplate::insert($tempalteData);
        }

        // dd($emails);

        foreach ($emails as $email) {

            $dataArr = array('campaign_id' => $campaign_id, 'email' => $email['email'], 'user_name' => $email['name'], 'user_id' => session()->get('user_id'),);
            $insertId = CampaignEmails::insertGetId($dataArr);
        }

        session()->forget('socialEmails');
        //   session()->forget('cid');
//        $campaign_id = session()->pull('cid');
//        $campaign = Campaign::find($campaign_id);
//        $data['campaign'] = $campaign;
         $con = array(
                'screen' => '9',
                'campaign_id'=>$campaign_id
            );
            $result = DB::table('campaign_screen')->where($con)->get()->toArray();
            $titleResult = DB::table('screen_step')->where(array('id' => '9'))->get()->first();
            $data['results']  = $result;
            $data['title']  = $titleResult->name; 
        $data['i'] = $campaign_id;

        return view('system/save-msg', $data);
    }

    public function saveContacts(Request $request) {



        $allData = request()->all();
      
        request()->session()->put(['socialEmails' => $allData['emails'], 'cid' => $allData['cid']]);
        
        return response()->json(array('msg' => 'ok'));
    }


    //////////////////////


public function selectFacebook(Route $route) {
        $data['i'] = request()->input('i');
        $emailTemplate=EmailTemplate::where('campaign_id',request()->input('i'))->orderBy('id', 'desc')->first();
            $con = array(
                'screen' => '3',
                'campaign_id'=>request()->input('i')
            );
            $result = DB::table('campaign_screen')->where($con)->get()->toArray();
            $titleResult = DB::table('screen_step')->where(array('id' => '3'))->get()->first();
            $data['results']  = $result;
            $data['title']  = $titleResult->name;
            //echo Route::getCurrentRoute()->getActionName();
            //echo Route::getActionMethod();
            $data['method'] = $route->getActionMethod();
           return view('system/selected-platform', $data);
    }

public function selectYahoo(Route $route) {
        $data['i'] = request()->input('i');
        
        $emailTemplate=EmailTemplate::where('campaign_id',request()->input('i'))
                                ->orderBy('id', 'desc')
                                ->first();

            $con = array(
                'screen' => '4',
                'campaign_id'=>request()->input('i')
            );
            $result = DB::table('campaign_screen')->where($con)->get()->toArray();
            $titleResult = DB::table('screen_step')->where(array('id' => '4'))->get()->first();
            $data['results']  = $result;
            $data['title']  = $titleResult->name;                                
            $data['method'] = $route->getActionMethod();  
        return view('system/selected-platform', $data);
    }

 public function selectGoogle(Route $route) {
        $data['i'] = request()->input('i');
        $emailTemplate=EmailTemplate::where('campaign_id',request()->input('i'))
                                ->orderBy('id', 'desc')
                                ->first();

            $con = array(
                'screen' => '5',
                'campaign_id'=>request()->input('i')
            );
            $result = DB::table('campaign_screen')->where($con)->get()->toArray();
           $titleResult = DB::table('screen_step')->where(array('id' => '5'))->get()->first();
            $data['results']  = $result;
            $data['title']  = $titleResult->name;
              
        $data['method'] = $route->getActionMethod();            
        return view('system/selected-platform', $data);
    }

    public function selectVcard(Route $route) {
        $data['i'] = request()->input('i');
        $emailTemplate=EmailTemplate::where('campaign_id',request()->input('i'))
                                ->orderBy('id', 'desc')
                                ->first();
            $con = array(
                'screen' => '1',
                'campaign_id'=>request()->input('i')
            );
            $result = DB::table('campaign_screen')->where($con)->get()->toArray();
            $titleResult = DB::table('screen_step')->where(array('id' => '1'))->get()->first();
            $data['results']  = $result;
            $data['title']  = $titleResult->name;

            $data['method'] = $route->getActionMethod();  
        return view('system/selected-platform', $data);
    }

public function selectLinkedin(Route $route) {
        $data['i'] = request()->input('i');
        $emailTemplate=EmailTemplate::where('campaign_id',request()->input('i'))
                                ->orderBy('id', 'desc')
                                ->first();


           $con = array(
                'screen' => '2',
                'campaign_id'=>request()->input('i')
            );
            $result = DB::table('campaign_screen')->where($con)->get()->toArray();
            $titleResult = DB::table('screen_step')->where(array('id' => '2'))->get()->first();
            $data['results']  = $result;
            $data['title']  = $titleResult->name;

           $data['method'] = $route->getActionMethod();  
        return view('system/selected-platform', $data);
    }

public function selectPlatform(Route $route) {
    
      //IF THERE IS ANY EMAIL LIST SAVED IN SESSION, CLEAR IT
  $user_id = Session::get('admin_id');
       // dd($user_id);
        session()->forget('socialEmails');
        $data['i'] = request()->input('i');
        $emailTemplate=EmailTemplate::where('campaign_id',request()->input('i'))->orderBy('id', 'desc')->first();
           
           $con = array(
                'screen' => '6',
                'campaign_id'=>request()->input('i')
            );
            $result = DB::table('campaign_screen')->where($con)->get()->toArray();
            $titleResult = DB::table('screen_step')->where(array('id' => '6'))->get()->first();
            $data['results']  = $result;
            $data['title']  = $titleResult->name; 
            $data['method'] = $route->getActionMethod();
        return view('system/selected-platform', $data);
    }

    //////////////////////

}
