<?php

namespace App\Modules\CalendarEvent\Providers;

use App\Modules\CalendarEvent\Interfaces\DeleteEventSchedulesServiceInterface;
use App\Modules\CalendarEvent\Services\DeleteEventSchedulesService;
use Illuminate\Support\ServiceProvider;

class DeleteEventSchedulesServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(
            DeleteEventSchedulesServiceInterface::class,
            DeleteEventSchedulesService::class
        );
    }
}
