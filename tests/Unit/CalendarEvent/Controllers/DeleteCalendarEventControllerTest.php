<?php

namespace Tests\Unit\CalendarEvent\Controllers;

use Tests\TestCase;
use App\Modules\CalendarEvent\Controllers\DeleteCalendarEventController;
use App\Modules\CalendarEvent\Interfaces\DeleteCalendarEventServiceInterface;
use Illuminate\Http\Response;
use Mockery;

class DeleteCalendarEventControllerTest extends TestCase
{
    public function testInvoke()
    {
        //Arrange
        $service = Mockery::mock(DeleteCalendarEventServiceInterface::class);
        $controller = new DeleteCalendarEventController($service);

        $calendarEventId = 1;
        $service->shouldReceive('__invoke')
            ->once()
            ->with($calendarEventId)
            ->andReturnNull();

        //ACT
        $response = $controller($calendarEventId);

        // Assert
        $this->assertEquals(Response::HTTP_NO_CONTENT, $response->getStatusCode());
    }
}
