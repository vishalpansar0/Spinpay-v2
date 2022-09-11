<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WarningMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $msg;
    protected $v;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($msg,$v)
    {
        $this->msg = $msg;
        $this->v = $v;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('cppsecretstools@gmail.com', 'SpinPay')
        ->view($this->v)->with(['msg'=> $this->msg]);
    }
}
