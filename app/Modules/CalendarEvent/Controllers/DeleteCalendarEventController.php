<?php

/**
 * @OA\Delete(
 *     path="/calendar-event/{id}",
 *     summary="Delete a calendar event",
 *     tags={"CalendarEvent"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="Calendar Event ID",
 *         required=true,
 *         @OA\Schema(
 *             type="integer"
 *         )
 *     ),
 *     @OA\Response(
 *         response=204,
 *         description="No Content"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not Found"
 *     )
 * )
 */
namespace App\Modules\CalendarEvent\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\CalendarEvent\Interfaces\DeleteCalendarEventServiceInterface;
use Illuminate\Http\Response;

class DeleteCalendarEventController extends Controller
{
    public function __construct(
        private readonly DeleteCalendarEventServiceInterface $deleteCalendarEventService
    ) {
    }
    public function __invoke(int $calendarEventId): Response
    {
        ($this->deleteCalendarEventService)($calendarEventId);

        return response()->noContent();
    }
}
