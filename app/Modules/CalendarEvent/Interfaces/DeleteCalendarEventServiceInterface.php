<?php

namespace App\Modules\CalendarEvent\Interfaces;

interface DeleteCalendarEventServiceInterface
{
    public function __invoke(int $id): void;
}
