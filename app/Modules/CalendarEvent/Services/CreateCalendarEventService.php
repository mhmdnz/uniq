<?php

namespace App\Modules\CalendarEvent\Services;

use App\Models\CalendarEvent;
use App\Modules\CalendarEvent\DTOs\CalendarEventDTO;
use App\Modules\CalendarEvent\Interfaces\CalendarEventRepositoryInterface;
use App\Modules\CalendarEvent\Interfaces\CreateCalendarEventServiceInterface;
use App\Modules\CalendarEvent\Interfaces\GetRecurringDatesServiceInterface;

class CreateCalendarEventService implements CreateCalendarEventServiceInterface
{

    public function __construct(
        private readonly GetRecurringDatesServiceInterface $getRecurringDatesService,
        private readonly CalendarEventRepositoryInterface $calendarEventRepository
    ) {
    }

    public function __invoke(CalendarEventDTO $calendarEventDTO): CalendarEvent
    {
        $getRecurringDates = ($this->getRecurringDatesService)($calendarEventDTO);

        return ($this->calendarEventRepository)->createWithEventSchedules(
            $getRecurringDates,
            $calendarEventDTO
        );
    }
}
