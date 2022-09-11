<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LenderRepayedMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $message;
    protected $v;
    protected $tid;
    protected $loanid;
    protected $amount;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($v,$message,$tid,$loanid,$amount)
    {
        //
        $this->v=$v;
        $this->message=$message;
        $this->tid=$tid;
        $this->loanid=$loanid;
        $this->amount=$amount;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('cppsecretstools@gmail.com', 'SpinPay')
        ->view($this->v)->with(['loanid'=>$this->loanid,
        'tid'=>$this->tid,
        'message'=>$this->message,
        'amount'=>$this->amount
    ]);
    }
}
