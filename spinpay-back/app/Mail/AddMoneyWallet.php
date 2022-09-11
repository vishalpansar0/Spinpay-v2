<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AddMoneyWallet extends Mailable
{
    use Queueable, SerializesModels;
    protected $money;
    protected $total;
    protected $v;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($v,$m,$total)
    {
        $this->v = $v;
        $this->money = $m;
        $this->total = $total;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('cppsecretstools@gmail.com', 'SpinPay')
        ->view($this->v)->with(['money'=>$this->money,'total'=>$this->total]);
    }
}
