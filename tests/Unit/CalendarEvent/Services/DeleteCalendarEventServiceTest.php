<?php

namespace Tests\Unit\CalendarEvent\Services;

use Tests\TestCase;
use App\Modules\CalendarEvent\Services\DeleteCalendarEventService;
use App\Modules\CalendarEvent\Interfaces\CalendarEventRepositoryInterface;
use Mockery;

class DeleteCalendarEventServiceTest extends TestCase
{
    public function testInvokeDeletesCalendarEventSuccessfully()
    {
        //ARRANGE
        $calendarEventRepositoryMock = Mockery::mock(CalendarEventRepositoryInterface::class);
        $sut = new DeleteCalendarEventService($calendarEventRepositoryMock);
        $id = 1;

        $calendarEventRepositoryMock
            ->shouldReceive('deleteById')
            ->once()
            ->with($id)
            ->andReturnTrue();

        // ACT
        ($sut)($id);
    }

}
