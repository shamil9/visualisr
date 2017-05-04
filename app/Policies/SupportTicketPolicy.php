<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class SupportTicketPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function before()
    {
        if (auth()->user()->admin) return true;
    }

    public function manage()
    {
        return false;
    }
}
