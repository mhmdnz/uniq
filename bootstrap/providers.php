<?php

use App\Modules\CalendarEvent\Providers\CalendarEventRepositoryProvider;
use App\Modules\CalendarEvent\Providers\CreateCalendarEventServiceProvider;
use App\Modules\CalendarEvent\Providers\DeleteCalendarEventServiceProvider;
use App\Modules\CalendarEvent\Providers\DeleteEventSchedulesServiceProvider;
use App\Modules\CalendarEvent\Providers\EventScheduleRepositoryProvider;
use App\Modules\CalendarEvent\Providers\GetAllCalendarEventsServiceProvider;
use App\Modules\CalendarEvent\Providers\GetRecurringDatesServiceProvider;
use App\Modules\CalendarEvent\Providers\UpdateCalendarEventServiceProvider;

return [
    App\Providers\AppServiceProvider::class,
    GetRecurringDatesServiceProvider::class,
    CreateCalendarEventServiceProvider::class,
    CalendarEventRepositoryProvider::class,
    GetAllCalendarEventsServiceProvider::class,
    EventScheduleRepositoryProvider::class,
    DeleteCalendarEventServiceProvider::class,
    UpdateCalendarEventServiceProvider::class,
    DeleteEventSchedulesServiceProvider::class
];
