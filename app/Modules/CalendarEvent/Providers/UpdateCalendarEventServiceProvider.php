<?php

namespace App\Modules\CalendarEvent\Providers;

use App\Modules\CalendarEvent\Interfaces\UpdateCalendarEventServiceInterface;
use App\Modules\CalendarEvent\Services\UpdateCalendarEventService;
use Illuminate\Support\ServiceProvider;

class UpdateCalendarEventServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(
            UpdateCalendarEventServiceInterface::class,
            UpdateCalendarEventService::class
        );
    }
}
