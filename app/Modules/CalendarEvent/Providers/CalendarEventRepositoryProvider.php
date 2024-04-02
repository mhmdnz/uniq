<?php

namespace App\Modules\CalendarEvent\Providers;

use App\Modules\CalendarEvent\Interfaces\CalendarEventRepositoryInterface;
use App\Modules\CalendarEvent\Repositories\CalendarEventRepository;
use Illuminate\Support\ServiceProvider;

class CalendarEventRepositoryProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(
            CalendarEventRepositoryInterface::class,
            CalendarEventRepository::class
        );
    }
}
