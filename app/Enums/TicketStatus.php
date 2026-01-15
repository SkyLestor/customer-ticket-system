<?php

namespace App\Enums;

enum TicketStatus: string
{
    case OPEN = 'open';
    case CLOSED = 'closed';
    public function label(): string
    {
        return ucfirst($this->value);
    }
}
