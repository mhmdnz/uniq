<?php

namespace App\Modules\CalendarEvent\Interfaces;

use Illuminate\Contracts\Pagination\LengthAwarePaginator as LengthAwarePaginatorAlias;

interface GetAllCalendarEventsServiceInterface
{
    public function __invoke(): LengthAwarePaginatorAlias;
}
