<?php

namespace App\Modules\CalendarEvent\Interfaces;

use App\Modules\CalendarEvent\Collections\EventScheduleDTOCollection;
use App\Modules\CalendarEvent\DTOs\CalendarEventDTO;

interface GetRecurringDatesServiceInterface
{
    public function __invoke(CalendarEventDTO $calendarEventDTO): EventScheduleDTOCollection;
}
