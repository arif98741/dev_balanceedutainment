<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserSession {

        /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        if ($request->session()->exists('user_id') && !empty($request->session()->get('user_id'))) {

            $encodedData = json_decode(base64_decode($request->id), 1);
            $campaign_id = $encodedData['campaign_id'];
            return redirect()->action('AdminSocialController@selectPlatform', array('i' => $campaign_id));
        }

        return $next($request);
    }

}
