<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::get('/clear-cache', function() {

  echo 'hhh='.  $exitCode = Artisan::call('cache:clear');
 
    // return what you want
});

Route::get('/', function () {
    return redirect('admin');
});
//Route::group(['middleware' => 'auth'], function () {
Route::get('/delEmail', 'AdminCampaignPublishController@del_email');

Route::get('screen', 'AdminCampaignController@screen');
Route::get('campaign/{id?}', 'AdminCampaignController@show_campaign');
Route::get('campaign_report/{id?}', 'AdminCampaignController@campaign_report');
Route::get('campaigns_report', 'AdminCampaignController@campaigns_report');
Route::get('emails_report', 'AdminCampaignController@emails_report');
Route::get('user_report/{userId?}/{cid?}', 'AdminCampaignController@user_report');
Route::get('clickthrough_report/{id?}', 'AdminCampaignController@clickthrough_report');
Route::get('clickthrough_user_report/{campaign_id}/{user_id?}', 'AdminCampaignController@clickthrough_user_report');
Route::get('publish/{id?}', 'AdminCampaignPublishController@publish');
Route::post('/publish_campaign', 'AdminCampaignPublishController@publish_campaign');
Route::get('testemail', 'EmailController@sendEmail');

Route::get('yahooContacts', 'AdminSocialController@getYahooContacts');
Route::get('googleContacts', 'AdminSocialController@getGoogleContacts');
Route::get('facebookContacts', 'AdminSocialController@getFacebookContacts');
Route::get('linkedin', 'AdminSocialController@linkedin');
Route::get('uploadVcard', 'AdminSocialController@uploadVcard');
Route::post('/processVcard', 'AdminSocialController@processVcard');
Route::post('linkedinContacts', 'AdminSocialController@getLinkedinContacts');
Route::post('/saveSocialMedia', 'AdminSocialController@save_social_list');


Route::get('yahooContacts2', 'AdminSocialController@getYahooContacts2');
Route::get('googleContacts2', 'AdminSocialController@getGoogleContacts2');
Route::get('facebookContacts2', 'AdminSocialController@getFacebookContacts2');
Route::get('linkedin2', 'AdminSocialController@linkedin2');
Route::get('uploadVcard2', 'AdminSocialController@uploadVcard2');
Route::post('linkedinContacts2', 'AdminSocialController@getLinkedinContacts2');
Route::post('/processVcard2', 'AdminSocialController@processVcard2');

//system process
Route::group(['middleware' => ['checkUserSession']], function () {
    Route::get('getStart/{id?}', 'AdminSocialController@getStart');
    
});
Route::post('updateCampaign', 'AdminSocialController@updateCampaign');
Route::post('updateTemplate', 'AdminSocialController@updateTemplate');
Route::post('updateScreen', 'AdminSocialController@updateScreen');
Route::get('checkScreen', 'AdminSocialController@checkScreen');
Route::get('getScreen', 'AdminSocialController@getScreen');
Route::post('sendMail', 'AdminCampaignPublishController@sendMail');
Route::get('proceedStart', 'AdminSocialController@proceedStart');
Route::get('selectPlatform', 'AdminSocialController@selectPlatform');
Route::post('saveContacts', 'AdminSocialController@saveContacts');
Route::get('selectYahoo', 'AdminSocialController@selectYahoo');
Route::get('selectGoogle', 'AdminSocialController@selectGoogle');
Route::get('selectFacebook', 'AdminSocialController@selectFacebook');
Route::get('selectLinkedin', 'AdminSocialController@selectLinkedin');
Route::get('uploadForLinkedin', 'AdminSocialController@uploadForLinkedin');
Route::get('selectVcard', 'AdminSocialController@selectVcard');
Route::get('uploadForVcard', 'AdminSocialController@uploadForLinkedin');
Route::get('composeMsg', 'AdminSocialController@composeMsg');
Route::post('saveMsg', 'AdminSocialController@saveMsg');

//    facebook login
Route::get('facebookLogin', 'Auth\LoginController@facebookLogin');
Route::get('facebookCallback', 'Auth\LoginController@facebookCallback');


//});
