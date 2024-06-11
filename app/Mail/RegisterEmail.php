<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->view('front.pages.email.register-email')
                    ->from('hello@bne.live','BNE Live')
                    ->replyTo('hello@bne.live','BNE Live')
                    ->subject('Registration successfull!')
                    ->with($this->data);
    }
}
