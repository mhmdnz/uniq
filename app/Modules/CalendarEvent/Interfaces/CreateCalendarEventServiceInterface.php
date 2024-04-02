<?php

namespace App\Modules\CalendarEvent\Interfaces;

use App\Models\CalendarEvent;
use App\Modules\CalendarEvent\DTOs\CalendarEventDTO;

interface CreateCalendarEventServiceInterface
{
    public function __invoke(CalendarEventDTO $calendarEventDTO): CalendarEvent;
}
