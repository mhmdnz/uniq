<?php

namespace App\Modules\CalendarEvent\Providers;

use App\Modules\CalendarEvent\Interfaces\GetRecurringDatesServiceInterface;
use App\Modules\CalendarEvent\Services\GetRecurringDatesService;
use Illuminate\Support\ServiceProvider;

class GetRecurringDatesServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(
            GetRecurringDatesServiceInterface::class,
            GetRecurringDatesService::class
        );
    }
}
