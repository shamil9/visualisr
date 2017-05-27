<?php

namespace App\Mail;

use App\UnconfirmedUser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmAccount extends Mailable
{
    use Queueable, SerializesModels;

    public $unconfirmedUser;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(UnconfirmedUser $unconfirmedUser)
    {
        $this->unconfirmedUser = $unconfirmedUser;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Confirm Account')
            ->markdown('email.users.confirm');
    }
}
