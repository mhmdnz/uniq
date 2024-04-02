<?php

namespace App\Modules\CalendarEvent\Providers;

use App\Modules\CalendarEvent\Interfaces\DeleteCalendarEventServiceInterface;
use App\Modules\CalendarEvent\Services\DeleteCalendarEventService;
use Illuminate\Support\ServiceProvider;

class DeleteCalendarEventServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(
            DeleteCalendarEventServiceInterface::class,
            DeleteCalendarEventService::class
        );
    }
}
