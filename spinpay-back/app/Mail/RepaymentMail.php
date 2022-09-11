<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RepaymentMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $loanamount;
    protected $loanid;
    protected $tid;
    protected $message;
    protected $processing_fee;
    protected $late_fee;
    protected $interest;
    protected $gst;
    protected $total;
    protected $v;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($v,$message,$tid,$loanid,$loanamount,$processing_fee,$interest,$late_fee,$gst,$total)
    {
        //
        $this->loanamount=$loanamount;
        $this->loanid=$loanid;
        $this->tid=$tid;
        $this->interest=$interest;
        $this->processing_fee=$processing_fee;
        $this->late_fee=$late_fee;
        $this->gst=$gst;
        $this->total=$total;
        $this->v=$v;
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
        'loanamount'=> $this->loanamount,
        'tid'=>$this->tid,
        'message'=>$this->message,
        'processing_fee'=>$this->processing_fee,
        'interest'=>$this->interest,
        'late_fee'=>$this->late_fee,
        'gst'=>$this->gst,
        'total'=>$this->total
        ]);
    }
}
