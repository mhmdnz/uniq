<?php

namespace Tests\Unit\CalendarEvent\Controllers;

use App\Modules\CalendarEvent\Controllers\UpdateCalendarEventController;
use App\Modules\CalendarEvent\DTOs\CalendarEventDTO;
use App\Modules\CalendarEvent\Interfaces\UpdateCalendarEventServiceInterface;
use App\Modules\CalendarEvent\Requests\UpdateCalendarEventRequest;
use App\Modules\CalendarEvent\Resources\CalendarEventResource;
use Mockery;
use App\Models\CalendarEvent;
use Tests\TestCase;

class UpdateCalendarEventControllerTest extends TestCase
{
    public function testInvoke()
    {
        // Arrange
        $service = Mockery::mock(UpdateCalendarEventServiceInterface::class);
        $controller = new UpdateCalendarEventController($service);

        $calendarEventId = 1; // Example Calendar Event ID
        $requestData = [
            'title' => 'Updated Event',
            'start' => '2023-01-01',
            'end' => '2023-01-01',
            'description' => 'Updated Description',
            'recurring' => true,
            'frequency' => 'daily',
            'repeat_until' => '2023-01-10',
        ];

        $request = UpdateCalendarEventRequest::create("/calendar-event/{$calendarEventId}", 'PUT', $requestData);
        $service->shouldReceive('__invoke')
            ->once()
            ->withArgs(function ($id, CalendarEventDTO $dto) use ($calendarEventId, $requestData) {
                return $id === $calendarEventId
                    && $dto->title === $requestData['title']
                    && $dto->start === $requestData['start'];
                // Add more checks as necessary
            })
            ->andReturn(CalendarEvent::factory()->make());

        // ACT
        $response = $controller->__invoke($request, $calendarEventId);

        // Assert
        $this->assertInstanceOf(CalendarEventResource::class, $response);
    }
}
