<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/calendar-event')
    ->namespace('App\Modules\CalendarEvent\Controllers')
    ->group(static function (): void {
        Route::post('/', 'AddCalendarEventController');
        Route::get('/', 'GetCalendarEventListController');
        Route::put('/{id}', 'UpdateCalendarEventController');
        Route::delete('/{id}', 'DeleteCalendarEventController');
    });
