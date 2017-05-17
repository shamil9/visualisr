<?php

namespace App\Observers;

use App\Mail\SupportTicketCreated;
use App\SupportTicket;
use Illuminate\Support\Facades\Mail;

class SupportTicketObserver
{
    /**
     * Listen to the SupportTicket created event.
     *
     * @param SupportTicket $supportTicket
     * @return void
     */
    public function created(SupportTicket $supportTicket)
    {
        Mail::to('contact@visualisr.space')->queue(new SupportTicketCreated($supportTicket));
    }

    /**
     * Listen to the SupportTicket deleting event.
     *
     * @param SupportTicket $supportTicket
     * @return void
     */
    public function deleting(SupportTicket $supportTicket)
    {
        //
    }
}
