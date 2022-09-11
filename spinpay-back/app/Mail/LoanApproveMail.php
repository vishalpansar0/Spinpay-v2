<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LoanApproveMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $loanid;
    protected $amount;
    protected $duedate;
    protected $v;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($v,$loanid,$amount,$duedate)
    {
        //
        $this->amount = $amount;
        $this->v = $v;
        $this->duedate = $duedate;
        $this->loanid = $loanid;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('cppsecretstools@gmail.com', 'SpinPay')
        ->view($this->v)->with(['amount'=> $this->amount,'loanid'=>$this->loanid,"duedate"=>$this->duedate]);
    }
}
