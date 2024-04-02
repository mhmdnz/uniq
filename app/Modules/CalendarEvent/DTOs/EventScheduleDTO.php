<?php

namespace App\Modules\CalendarEvent\DTOs;

class EventScheduleDTO extends \App\Models\EventSchedule
{
    public function __construct(
        public string $start,
        public string $end,
    ) {}
}
