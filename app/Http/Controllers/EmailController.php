<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class EmailController extends Controller {

        public function sendEmail() {

//                dd(\Config::get('mail'));
                $subject = 'test email';
                $title = 'HI, test email';
                $content = 'this is a test email by laravel.';

                Mail::send('email', ['title' => $title, 'content' => $content], function ($message) {

                        $message->subject('Test Email');
                        $message->from('adnan.spyko@gmail.com', 'Adnan');
                        $message->to('adnankust2@yahoo.com');
                        $message->setBody("this is a test email by laravel.", 'text/html');
                });

                if (count(Mail::failures()) > 0) {

                        echo "There was one or more failures. They were: <br />";

                        foreach (Mail::failures as $email_address) {
                                echo " - $email_address <br />";
                        }
                } else {
                        echo "No errors, all sent successfully!";
                }

//                return response()->json(['message' => 'Request completed']);
        }

}
