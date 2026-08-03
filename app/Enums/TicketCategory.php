<?php

namespace App\Enums;

enum TicketCategory: string
{
    case E_GENERAL = 'general';
    case E_BUG_REPORT = 'bug report';
    case E_INFORMATION = 'information';
    case E_REQUEST = 'request';
}
