<?php

namespace App\Modules\CalendarEvent\Providers;

use App\Modules\CalendarEvent\Interfaces\CreateCalendarEventServiceInterface;
use App\Modules\CalendarEvent\Services\CreateCalendarEventService;
use Illuminate\Support\ServiceProvider;

class CreateCalendarEventServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(
            CreateCalendarEventServiceInterface::class,
            CreateCalendarEventService::class
        );
    }
}
