<?php

namespace Vanguard\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Vanguard\Models\LogisticsTransferRequest;

class VehicleTransferRequest extends Mailable
{
    use Queueable, SerializesModels;

    public $transferRequest;

    public $sender;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(LogisticsTransferRequest $transferRequest)
    {
        $this->transferRequest = $transferRequest;
        $this->sender = is_null($this->transferRequest->email) ? 'info@stricklands.com' : $this->transferRequest->email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->sender)
            ->subject('New Vehicle Transfer Request')
            ->markdown('emails.notifications.transfer-request');
    }
}
