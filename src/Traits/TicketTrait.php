<?php

namespace WeWork\Traits;

use WeWork\ApiCache\Ticket;

trait TicketTrait
{
    /**
     * @var Ticket
     */
    protected $ticket;

    /**
     * @param Ticket $ticket
     */
    public function setTicket(Ticket $ticket): void
    {
        $this->ticket = $ticket;
    }
}
