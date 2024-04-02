<?php

namespace Tests\Unit\CalendarEvent\Services;

use Tests\TestCase;
use App\Models\CalendarEvent;
use App\Modules\CalendarEvent\Collections\EventScheduleDTOCollection;
use App\Modules\CalendarEvent\DTOs\CalendarEventDTO;
use App\Modules\CalendarEvent\Interfaces\CalendarEventRepositoryInterface;
use App\Modules\CalendarEvent\Interfaces\DeleteEventSchedulesServiceInterface;
use App\Modules\CalendarEvent\Interfaces\GetRecurringDatesServiceInterface;
use App\Modules\CalendarEvent\Services\UpdateCalendarEventService;
use Mockery;

class UpdateCalendarEventServiceTest extends TestCase
{
    public function testInvokeUpdatesCalendarEventSuccessfully()
    {
        //Arrange
        $getRecurringDatesServiceMock = Mockery::mock(GetRecurringDatesServiceInterface::class);
        $calendarEventRepositoryMock = Mockery::mock(CalendarEventRepositoryInterface::class);
        $deleteEventSchedulesServiceMock = Mockery::mock(DeleteEventSchedulesServiceInterface::class);

        $calendarEventId = 1;
        $calendarEventDTO = new CalendarEventDTO(
            start: '2023-04-01',
            end: '2023-04-01',
            recurring: true,
            frequency: 'daily',
            repeatUntil: '2023-04-03',
            title: 'Updated Event',
            description: 'Updated description'
        );
        $updatedCalendarEvent = Mockery::mock(CalendarEvent::class);
        $eventScheduleDTOCollection = new EventScheduleDTOCollection();

        $calendarEventRepositoryMock
            ->shouldReceive('updateData')
            ->once()
            ->withArgs([$calendarEventId, 'Updated Event', 'Updated description'])
            ->andReturn($updatedCalendarEvent);

        $deleteEventSchedulesServiceMock
            ->shouldReceive('__invoke')
            ->once()
            ->with($calendarEventId);

        $getRecurringDatesServiceMock
            ->shouldReceive('__invoke')
            ->once()
            ->with($calendarEventDTO)
            ->andReturn($eventScheduleDTOCollection);

        $calendarEventRepositoryMock
            ->shouldReceive('createWithEventSchedules')
            ->once()
            ->withArgs(function ($schedules, $notused, $id) use ($eventScheduleDTOCollection, $calendarEventId) {
                return $schedules === $eventScheduleDTOCollection && $id === $calendarEventId;
            })
            ->andReturn($updatedCalendarEvent);

        $updatedCalendarEvent
            ->shouldReceive('load')
            ->once()
            ->with('eventSchedules')
            ->andReturn($updatedCalendarEvent);

        $sut = new UpdateCalendarEventService(
            $getRecurringDatesServiceMock,
            $calendarEventRepositoryMock,
            $deleteEventSchedulesServiceMock
        );

        //ACT
        $result = $sut($calendarEventId, $calendarEventDTO);

        //ASSERT
        $this->assertInstanceOf(CalendarEvent::class, $result);
    }
}
