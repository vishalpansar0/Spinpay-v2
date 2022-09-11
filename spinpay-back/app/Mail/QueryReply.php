<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QueryReply extends Mailable
{
    use Queueable, SerializesModels;
    private $reply;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reply)
    {
        $this->reply = $reply;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('cppsecretstools@gmail.com', 'SpinPay')
        ->view($this->v)->with(['reply'=> $this->reply]);
    }
}
