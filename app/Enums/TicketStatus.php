<?php

namespace App\Enums;

enum TicketStatus: string
{
    case E_SUBMITTED = 'submitted';
    case E_IN_PROGESS = 'in_progress';
    case E_CANCELED = 'canceled';
    case E_CLOSED = 'closed';
}