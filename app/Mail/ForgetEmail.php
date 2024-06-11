<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgetEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->view('front.pages.email.reminder')
                    ->from('hello@bne.live','BNE Live')
                    ->replyTo('hello@bne.live','BNE Live')
                    ->subject('Forget Password')
                    ->with($this->data);
    }
}
