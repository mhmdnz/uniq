<?php

namespace App\Modules\CalendarEvent\Services;

use App\Modules\CalendarEvent\Interfaces\CalendarEventRepositoryInterface;
use App\Modules\CalendarEvent\Interfaces\DeleteCalendarEventServiceInterface;

class DeleteCalendarEventService implements DeleteCalendarEventServiceInterface
{
    public function __construct(private CalendarEventRepositoryInterface $calendarEventRepository)
    {
    }

    public function __invoke(int $id): void
    {
        ($this->calendarEventRepository)->deleteById($id);
    }
}
