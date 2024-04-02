<?php

namespace App\Modules\CalendarEvent\Interfaces;

use App\Models\CalendarEvent;
use App\Modules\CalendarEvent\DTOs\CalendarEventDTO;
use PhpParser\Builder\Interface_;

interface UpdateCalendarEventServiceInterface
{
    public function __invoke(int $calendarEventId, CalendarEventDTO $calendarEventDTO): CalendarEvent;
}
