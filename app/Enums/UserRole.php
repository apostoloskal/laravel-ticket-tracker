<?php

namespace App\Enums;

enum UserRole: string
{
    case E_ADMIN ='admin';
    case E_EMPLOYEE = 'employee';
    case E_CUSTOMER = 'customer';
}