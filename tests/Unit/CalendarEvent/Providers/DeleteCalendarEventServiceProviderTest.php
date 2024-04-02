<?php

namespace Tests\Unit\CalendarEvent\Providers;

use App\Modules\CalendarEvent\Interfaces\DeleteCalendarEventServiceInterface;
use App\Modules\CalendarEvent\Services\DeleteCalendarEventService;
use Tests\TestCase;

class DeleteCalendarEventServiceProviderTest extends TestCase
{
    public function testRepositorySingleton()
    {
        //Arrange
        $sut = resolve(DeleteCalendarEventServiceInterface::class);

        //Assert
        $this->assertInstanceOf(DeleteCalendarEventService::class, $sut);
    }
}
