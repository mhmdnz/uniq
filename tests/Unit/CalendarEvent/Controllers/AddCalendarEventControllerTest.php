<?php

namespace Tests\Unit\CalendarEvent\Controllers;

use App\Models\CalendarEvent;
use App\Modules\CalendarEvent\Controllers\AddCalendarEventController;
use App\Modules\CalendarEvent\DTOs\CalendarEventDTO;
use App\Modules\CalendarEvent\Interfaces\CreateCalendarEventServiceInterface;
use App\Modules\CalendarEvent\Requests\AddCalendarEventRequest;
use App\Modules\CalendarEvent\Resources\CalendarEventResource;
use Mockery;
use Tests\TestCase;

class AddCalendarEventControllerTest extends TestCase
{
    public function testInvoke()
    {
        //ARRANGE
        $service = Mockery::mock(CreateCalendarEventServiceInterface::class);
        $controller = new AddCalendarEventController($service);

        $request = AddCalendarEventRequest::create('/calendar-event', 'POST', [
            'title' => 'Test Event',
            'start' => '2023-01-01',
            'end' => '2023-01-01',
            'description' => 'Test Description',
            'recurring' => false,
            'frequency' => null,
            'repeat_until' => null,
        ]);

        $service->shouldReceive('__invoke')
            ->once()
            ->withArgs(function (CalendarEventDTO $dto) {
                return true;
            })
            ->andReturn(CalendarEvent::factory()->make());

        //ACT
        $response = $controller($request);

        //Assert
        $this->assertInstanceOf(CalendarEventResource::class, $response);
    }
}
