<?php

namespace App\Modules\CalendarEvent\Providers;

use App\Modules\CalendarEvent\Interfaces\EventScheduleRepositoryInterface;
use App\Modules\CalendarEvent\Repositories\EventScheduleRepository;
use Illuminate\Support\ServiceProvider;

class EventScheduleRepositoryProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(
            EventScheduleRepositoryInterface::class,
            EventScheduleRepository::class
        );
    }
}
