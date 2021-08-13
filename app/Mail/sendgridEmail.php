<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class sendgridEmail extends Mailable {

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
   public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
//dd($this->data);
        $address = $this->data['from'];
        $name = $this->data['name'];
        $to = $this->data['to'];
        $subject = $this->data['subject'];
        $content = $this->data['message'];
        return $this->view('email')
                        ->from($address, $name)
                        ->replyTo($address, $name)
                        ->to($to)
                        ->subject($subject)
                        ->with([ 'message' => $content]);
    }

}
