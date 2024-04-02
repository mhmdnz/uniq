<?php

namespace App\Modules\CalendarEvent\Services;

use App\Models\CalendarEvent;
use App\Modules\CalendarEvent\DTOs\CalendarEventDTO;
use App\Modules\CalendarEvent\Interfaces\CalendarEventRepositoryInterface;
use App\Modules\CalendarEvent\Interfaces\DeleteEventSchedulesServiceInterface;
use App\Modules\CalendarEvent\Interfaces\GetRecurringDatesServiceInterface;
use App\Modules\CalendarEvent\Interfaces\UpdateCalendarEventServiceInterface;

class UpdateCalendarEventService implements UpdateCalendarEventServiceInterface
{
    public function __construct(
        private readonly GetRecurringDatesServiceInterface $getRecurringDatesService,
        private readonly CalendarEventRepositoryInterface $calendarEventRepository,
        private readonly DeleteEventSchedulesServiceInterface $deleteEventSchedulesService
    ) {
    }

    public function __invoke(int $calendarEventId, CalendarEventDTO $calendarEventDTO): CalendarEvent
    {
        $calendarEvent = ($this->calendarEventRepository)->updateData(
            $calendarEventId,
            $calendarEventDTO->title,
            $calendarEventDTO->description
        );

        if ($calendarEventDTO->recurring || $calendarEventDTO->frequency || $calendarEventDTO->repeatUntil) {
            ($this->deleteEventSchedulesService)($calendarEventId);
            $getRecurringDates = ($this->getRecurringDatesService)($calendarEventDTO);

            $calendarEvent = ($this->calendarEventRepository)->createWithEventSchedules(
                eventScheduleDTOCollection: $getRecurringDates,
                calendarEventId: $calendarEventId
            );
        }

        return $calendarEvent->load('eventSchedules');
    }
}
