<?php

/**
 * @OA\Post(
 *     path="/calendar-event",
 *     summary="Create a new Calendar Event",
 *     operationId="createCalendarEvent",
 *     tags={"CalendarEvent"},
 *     @OA\RequestBody(
 *         required=true,
 *         description="Data for creating a new calendar event",
 *         @OA\JsonContent(ref="#/components/schemas/AddCalendarEventRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(ref="#/components/schemas/CalendarEventResource")
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Bad Request"
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Validation Error"
 *     )
 * )
 */
namespace App\Modules\CalendarEvent\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\CalendarEvent\DTOs\CalendarEventDTO;
use App\Modules\CalendarEvent\Interfaces\CreateCalendarEventServiceInterface;
use App\Modules\CalendarEvent\Requests\AddCalendarEventRequest;
use App\Modules\CalendarEvent\Resources\CalendarEventResource;

class AddCalendarEventController extends Controller
{
    public function __construct(
        private readonly CreateCalendarEventServiceInterface $createCalendarEventService
    ) {
    }
    public function __invoke(AddCalendarEventRequest $request): CalendarEventResource
    {
        $createdCalendarEvent = ($this->createCalendarEventService)(new CalendarEventDTO(
            title: $request->title,
            start: $request->start,
            end: $request->end,
            description: $request->description,
            recurring: $request->recurring,
            frequency: $request->frequency,
            repeatUntil: $request->repeat_until
        ));

        return CalendarEventResource::make($createdCalendarEvent);
    }
}
