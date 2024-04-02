<?php

namespace Tests\Unit\CalendarEvent\Providers;

use App\Modules\CalendarEvent\Interfaces\GetAllCalendarEventsServiceInterface;
use App\Modules\CalendarEvent\Services\GetAllCalenderEventsService;
use Tests\TestCase;

class GetAllCalendarEventsServiceProviderTest extends TestCase
{
    public function testRepositorySingleton()
    {
        //Arrange
        $sut = resolve(GetAllCalendarEventsServiceInterface::class);

        //Assert
        $this->assertInstanceOf(GetAllCalenderEventsService::class, $sut);
    }
}
