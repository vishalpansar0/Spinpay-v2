<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RejectMail extends Mailable
{
    use Queueable, SerializesModels;
    private $reason;
    private $v;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reason,$v)
    {
        $this->reason = $reason;
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
        ->view($this->v)->with(['reason'=> $this->reason]);
    }
}
