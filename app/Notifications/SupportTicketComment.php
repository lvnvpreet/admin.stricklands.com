<?php

namespace Vanguard\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SupportTicketComment extends Notification
{
    use Queueable;
    protected $ticket;
    protected $by;
    protected $comment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($ticket,$user,$comment)
    {
        $this->ticket = $ticket;
        $this->by = $user;
        $this->comment = $comment;
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
                    ->subject('Update on your support ticket #'.$this->ticket->id)
                    ->greeting('Hi '.$notifiable->full_name)
                    ->line('A new comment is posted on your support ticket #'.$this->ticket->id.' by '.$this->by->full_name . '. You can find it below.')
                    ->line('`'.$this->comment->comment.'`')
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
