<?php

namespace Tests\Unit\CalendarEvent\Services;

use App\Modules\CalendarEvent\Collections\EventScheduleDTOCollection;
use Tests\TestCase;
use App\Models\CalendarEvent;
use App\Modules\CalendarEvent\DTOs\CalendarEventDTO;
use App\Modules\CalendarEvent\Interfaces\CalendarEventRepositoryInterface;
use App\Modules\CalendarEvent\Interfaces\GetRecurringDatesServiceInterface;
use App\Modules\CalendarEvent\Services\CreateCalendarEventService;
use Mockery;

class CreateCalendarEventServiceTest extends TestCase
{
    public function testInvokeCreatesCalendarEventSuccessfully()
    {
        //Arrange
        $getRecurringDatesServiceMock = Mockery::mock(GetRecurringDatesServiceInterface::class);
        $calendarEventRepositoryMock = Mockery::mock(CalendarEventRepositoryInterface::class);

        $sut = new CreateCalendarEventService(
            $getRecurringDatesServiceMock,
            $calendarEventRepositoryMock
        );
        $calendarEventDTO = Mockery::mock(CalendarEventDTO::class);
        $expectedCalendarEvent = Mockery::mock(CalendarEvent::class);
        $eventScheduleDTOCollection = Mockery::mock(EventScheduleDTOCollection::class);

        $getRecurringDatesServiceMock
            ->shouldReceive('__invoke')
            ->once()
            ->with($calendarEventDTO)
            ->andReturn($eventScheduleDTOCollection);

        $calendarEventRepositoryMock
            ->shouldReceive('createWithEventSchedules')
            ->once()
            ->with($eventScheduleDTOCollection, $calendarEventDTO)
            ->andReturn($expectedCalendarEvent);

        //ACT
        $result = ($sut)($calendarEventDTO);

        //ASSERT
        $this->assertInstanceOf(CalendarEvent::class, $result);
        $this->assertEquals($expectedCalendarEvent, $result);
    }
}
