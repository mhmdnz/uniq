<?php

/**
 * @OA\Get(
 *     path="/calendar-event",
 *     summary="Get list of all Calendar Events",
 *     operationId="getCalendarEventList",
 *     tags={"CalendarEvent"},
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(
 *                 property="data",
 *                 type="array",
 *                 @OA\Items(ref="#/components/schemas/CalendarEventResource"),
 *                 description="An array of calendar events"
 *             ),
 *             @OA\Property(
 *                 property="links",
 *                 type="object",
 *                 @OA\Property(property="first", type="string", format="uri", example="http://localhost/api/calendar-event?page=1"),
 *                 @OA\Property(property="last", type="string", format="uri", example="http://localhost/api/calendar-event?page=1"),
 *                 @OA\Property(property="prev", type="string", format="uri", example=null),
 *                 @OA\Property(property="next", type="string", format="uri", example=null),
 *                 description="Links to other pages of results"
 *             ),
 *             @OA\Property(
 *                 property="meta",
 *                 type="object",
 *                 @OA\Property(property="current_page", type="integer", example=1),
 *                 @OA\Property(property="from", type="integer", example=1),
 *                 @OA\Property(property="last_page", type="integer", example=1),
 *                 @OA\Property(property="path", type="string", format="uri", example="http://localhost/api/calendar-event"),
 *                 @OA\Property(property="per_page", type="integer", example=15),
 *                 @OA\Property(property="to", type="integer", example=6),
 *                 @OA\Property(property="total", type="integer", example=6),
 *                 description="Metadata about the pagination"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="No Calendar Events found"
 *     )
 * )
 */

namespace App\Modules\CalendarEvent\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\CalendarEvent\Interfaces\GetAllCalendarEventsServiceInterface;
use App\Modules\CalendarEvent\Resources\CalendarEventCollection;

class GetCalendarEventListController extends Controller
{

    public function __construct(
        private GetAllCalendarEventsServiceInterface $getAllCalendarEventsService
    ) {
    }
    public function __invoke(): CalendarEventCollection
    {
        return CalendarEventCollection::make(($this->getAllCalendarEventsService)());
    }
}
