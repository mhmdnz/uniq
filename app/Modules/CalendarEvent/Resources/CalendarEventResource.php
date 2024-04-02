<?php

/**
 * @OA\Schema(
 *     title="CalendarEventResource",
 *     description="Calendar event resource",
 *     @OA\Xml(name="CalendarEventResource")
 * )
 */
namespace App\Modules\CalendarEvent\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class CalendarEventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @OA\Property(property="id", type="integer", example=1),
     * @OA\Property(property="title", type="string", example="Event Title"),
     * @OA\Property(property="description", type="string", example="Event Description"),
     * @OA\Property(property="created_at", type="string", format="date-time", example="2021-03-10T15:00:00Z"),
     * @OA\Property(property="updated_at", type="string", format="date-time", example="2021-03-10T15:00:00Z"),
     * @OA\Property(
     *    property="event_schedules",
     *    type="array",
     *    @OA\Items(ref="#/components/schemas/EventSchedulesCollection")
     * )
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'event_schedules' => EventSchedulesCollection::make($this->eventSchedules),
        ];
    }
}
