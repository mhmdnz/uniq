<?php

namespace App\Modules\CalendarEvent\Services;

use App\Modules\CalendarEvent\Interfaces\DeleteEventSchedulesServiceInterface;
use App\Modules\CalendarEvent\Interfaces\EventScheduleRepositoryInterface;

class DeleteEventSchedulesService implements DeleteEventSchedulesServiceInterface
{
    public function __construct(private EventScheduleRepositoryInterface $eventScheduleRepository)
    {
    }

    public function __invoke(int $calendarEventId): void
    {
        ($this->eventScheduleRepository)->deleteByCalendarEventId($calendarEventId);
    }
}
