<?php

namespace Vanguard\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Vanguard\Models\LogisticsTransferRequest;

class TransferRquestResult extends Mailable
{
    use Queueable, SerializesModels;

    public $transferRequest;
    public $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(LogisticsTransferRequest $transferRequest)
    {
        $this->transferRequest = $transferRequest;
        $this->message = ($this->transferRequest->transfered == 1) ? "Your transfer request for stock # " . $transferRequest->stock_no . " has been authorized." : "Your transfer request for stock # " . $transferRequest->stock_no . " has been declined.";
        $this->subject = ($this->transferRequest->transfered == 1) ? "Transfer Request Authorized" : "Transfer Request Declined";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('logistics@stricklands.com')
            ->subject($this->subject)->markdown('emails.notifications.transfer-request-result');
    }
}
