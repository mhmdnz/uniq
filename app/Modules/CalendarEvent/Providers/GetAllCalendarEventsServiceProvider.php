<?php

namespace App\Modules\CalendarEvent\Providers;

use App\Modules\CalendarEvent\Interfaces\GetAllCalendarEventsServiceInterface;
use App\Modules\CalendarEvent\Services\GetAllCalenderEventsService;
use Illuminate\Support\ServiceProvider;

class GetAllCalendarEventsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(
            GetAllCalendarEventsServiceInterface::class,
            GetAllCalenderEventsService::class
        );
    }
}
