<?php

namespace Tests\Unit\CalendarEvent\Services;

use Tests\TestCase;
use App\Modules\CalendarEvent\Services\DeleteEventSchedulesService;
use App\Modules\CalendarEvent\Interfaces\EventScheduleRepositoryInterface;
use Mockery;

class DeleteEventSchedulesServiceTest extends TestCase
{
    public function testInvokeDeletesEventSchedulesSuccessfully()
    {
        //ARRANGE
        $eventScheduleRepositoryMock = Mockery::mock(EventScheduleRepositoryInterface::class);
        $sut = new DeleteEventSchedulesService($eventScheduleRepositoryMock);

        $calendarEventId = 1;

        $eventScheduleRepositoryMock
            ->shouldReceive('deleteByCalendarEventId')
            ->once()
            ->with($calendarEventId)
            ->andReturnTrue();

        // ACT
        $sut($calendarEventId);
    }
}
