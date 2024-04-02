<?php

namespace App\Modules\CalendarEvent\Services;

use App\Modules\CalendarEvent\Interfaces\GetAllCalendarEventsServiceInterface;
use App\Modules\CalendarEvent\Repositories\CalendarEventRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator as LengthAwarePaginatorAlias;

class GetAllCalenderEventsService implements GetAllCalendarEventsServiceInterface
{
    public function __construct(
        private readonly CalendarEventRepository $calendarEventRepository
    ) {
    }

    public function __invoke(): LengthAwarePaginatorAlias
    {
        return ($this->calendarEventRepository)->getAll();
    }
}
