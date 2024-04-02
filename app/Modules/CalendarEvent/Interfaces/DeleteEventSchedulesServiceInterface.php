<?php

namespace App\Modules\CalendarEvent\Interfaces;

interface DeleteEventSchedulesServiceInterface
{
    public function __invoke(int $calendarEventId): void;
}
