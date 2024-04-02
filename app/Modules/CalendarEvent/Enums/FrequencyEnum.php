<?php

namespace App\Modules\CalendarEvent\Enums;

enum FrequencyEnum: string
{
    case DAILY = 'daily';
    case WEEKLY = 'weekly';
    case MONTHLY = 'monthly';
    case YEARLY = 'yearly';
}
