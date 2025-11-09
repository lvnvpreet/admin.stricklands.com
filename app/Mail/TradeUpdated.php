<?php

namespace Vanguard\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TradeUpdated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user;
    public $stock;
    public $trade;
    public $tradeUpdated;
    public function __construct($user,$stock,$trade,$tradeUpdated)
    {
        $this->user = $user;
        $this->stock = $stock;
        $this->trade = $trade;
        $this->tradeUpdated = $tradeUpdated;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.trade-updated', array('user'=>$this->user,'stock'=>$this->stock,'trade'=>$this->trade,'tradeUpdated'=>$this->tradeUpdated));
    }
}
