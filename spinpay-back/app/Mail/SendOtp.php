<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendOtp extends Mailable
{
    use Queueable, SerializesModels;
    private $otp;
    private $v;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($otp,$view)
    {
        $this->otp = $otp;
        $this->v = $view;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('cppsecretstools@gmail.com', 'SpinPay')
        ->view($this->v)->with(['otp'=> $this->otp]);
    }
}
