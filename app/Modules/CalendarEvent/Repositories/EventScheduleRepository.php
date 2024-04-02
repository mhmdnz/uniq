<?php

namespace App\Modules\CalendarEvent\Repositories;

use App\Models\CalendarEvent;
use App\Models\EventSchedule;
use App\Modules\CalendarEvent\Interfaces\EventScheduleRepositoryInterface;
use Illuminate\Support\Collection;

class EventScheduleRepository implements EventScheduleRepositoryInterface
{

    public function getByDate(string $start, string $end): Collection
    {
        return EventSchedule::where('start', '<=', $end)
            ->where('end', '>=', $start)->get();
    }

    public function getCalendarEvent(int $id): CalendarEvent
    {
        $eventSchedule = EventSchedule::find($id);

        return $eventSchedule->calendarEvent;
    }

    public function deleteByCalendarEventId(int $calendarEventId): void
    {
        $calendarEvent = CalendarEvent::find($calendarEventId);
        $calendarEvent->eventSchedules()->delete();
    }
}
