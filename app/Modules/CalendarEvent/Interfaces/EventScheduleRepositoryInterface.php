<?php

namespace App\Modules\CalendarEvent\Interfaces;

use App\Models\CalendarEvent;
use Illuminate\Support\Collection;

interface EventScheduleRepositoryInterface
{
    public function getByDate(string $start, string $end, ?int $id = 0): Collection;

    public function getCalendarEvent(int $id): CalendarEvent;

    public function deleteByCalendarEventId(int $calendarEventId): void;
}
