<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\Campaign;
use App\CmsUsers;
use Session;
use Illuminate\Support\Facades\Request;

class LoginController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles authenticating users for the application and
      | redirecting them to your home screen. The controller uses a trait
      | to conveniently provide its functionality to your applications.
      |
     */

use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function facebookLogin(Request $request) {

        $post = $request::input('post');

        return Socialite::driver('facebook')->with(['state' => $post])->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function facebookCallback() {

        $state = request()->input('state');
        
        $encodedData = json_decode(base64_decode($state), 1);
        $campaign_id = $encodedData['campaign_id'];
        $viewData['i'] = $campaign_id;
        
        $user = Socialite::driver('facebook')->stateless()->user();

        $data = array(
            'name' => $user->name,
            'email' => $user->email,
            'token' => $user->token,
            'type' => 'facebook',
        );

        $find = array(
            'name' => $user->name,
            'email' => $user->email,
            'type' => 'facebook',
        );

        $findRes = CmsUsers::where($find)->first();
      
        if ($findRes) {
            $find = array(
                'user_id' => $findRes->id,
            );
            request()->session()->put($find);
        } else {
            $findRes = CmsUsers::insertGetId($data);
            $find = array(
                'user_id' => $findRes,
            );
            request()->session()->put($find);
        }
$viewData['campaign']=Campaign::where('id',$campaign_id)->orderBy('id', 'desc')->first();
$viewData['CmsUsers']=CmsUsers::orderBy('id', 'desc')->get();
return redirect()->to('selectPlatform?i='.$campaign_id);
        //return view('system/select-platform', $viewData);
    }

}
