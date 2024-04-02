<?php

/**
 * @OA\Schema(
 *     title="EventSchedulesResource",
 *     description="Event schedules resource",
 *     @OA\Xml(name="EventSchedulesResource")
 * )
 */
namespace App\Modules\CalendarEvent\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class EventSchedulesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @OA\Property(property="id", type="integer", example=1),
     * @OA\Property(property="start", type="string", format="date-time", example="2021-03-10T09:00:00Z"),
     * @OA\Property(property="end", type="string", format="date-time", example="2021-03-10T11:00:00Z")
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'start' => $this->start,
            'end' => $this->end,
        ];
    }
}
