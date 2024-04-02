<?php

/**
 * @OA\Put(
 *     path="/calendar-event/{id}",
 *     summary="Update an existing Calendar Event",
 *     operationId="updateCalendarEvent",
 *     tags={"CalendarEvent"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the Calendar Event to update",
 *         @OA\Schema(
 *             type="integer"
 *         )
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         description="Data for updating the calendar event",
 *         @OA\JsonContent(ref="#/components/schemas/UpdateCalendarEventRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Calendar event updated successfully",
 *         @OA\JsonContent(ref="#/components/schemas/CalendarEventResource")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Calendar Event not found"
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Validation error"
 *     )
 * )
 */
namespace App\Modules\CalendarEvent\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\CalendarEvent\DTOs\CalendarEventDTO;
use App\Modules\CalendarEvent\Interfaces\UpdateCalendarEventServiceInterface;
use App\Modules\CalendarEvent\Requests\UpdateCalendarEventRequest;
use App\Modules\CalendarEvent\Resources\CalendarEventResource;

class UpdateCalendarEventController extends Controller
{

    public function __construct(private UpdateCalendarEventServiceInterface $updateCalendarEventService)
    {
    }
    public function __invoke(
        UpdateCalendarEventRequest $request,
        int $calendarEventId
    ) {
        $updatedCalendarEvent = ($this->updateCalendarEventService)($calendarEventId, new CalendarEventDTO(
            title: $request->title,
            start: $request->start,
            end: $request->end,
            description: $request->description,
            recurring: $request->recurring,
            frequency: $request->frequency,
            repeatUntil: $request->repeat_until
        ));

        return CalendarEventResource::make($updatedCalendarEvent);
    }
}
