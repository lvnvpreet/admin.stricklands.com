<?php

namespace Vanguard\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SupportTicketClosed extends Notification
{
    use Queueable;

    protected  $ticket;
    protected $closedBy;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($ticket,$user)
    {
        $this->ticket = $ticket;
        $this->closedBy = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Support Ticket #' . $this->ticket->id . ' Closed ')
                    ->line('Support ticket #'. $this->ticket->id . ' is closed by ' . $this->closedBy->full_name)
                    ->action('View Support Ticket', route('support-ticket.view',$this->ticket->id))
                    ->line('Thank you');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
