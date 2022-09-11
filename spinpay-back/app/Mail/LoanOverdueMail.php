<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LoanOverdueMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $amount;
    protected $lastDate;
    protected $v;
    protected $id;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($v,$amt,$ld,$id)
    {
        $this->amount = $amt;
        $this->v = $v;
        $this->lastDate = $ld;
        $this->id = $id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('cppsecretstools@gmail.com', 'SpinPay')
        ->view($this->v)->with(['amount'=> $this->amount,'lastDate'=>$this->lastDate,"loanid"=>$this->id]);
    }
}
