<?php

namespace App\Mail;

use App\SupportTicket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SupportTicketCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $message;

    /**
     * Create a new message instance.
     *
     * @param SupportTicket $message
     */
    public function __construct(SupportTicket $message)
    {
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('New Support Ticket')
            ->from($this->message->email)
            ->markdown('email.support-ticket');
    }
}
