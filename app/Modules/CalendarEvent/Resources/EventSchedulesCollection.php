<?php

/**
 * @OA\Schema(
 *     title="EventSchedulesCollection",
 *     description="Event schedules collection",
 *     @OA\Xml(name="EventSchedulesCollection")
 * )
 */
namespace App\Modules\CalendarEvent\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class EventSchedulesCollection extends ResourceCollection
{
    /**
     * @OA\Property(
     *     property="data",
     *     type="array",
     *     @OA\Items(ref="#/components/schemas/EventSchedulesResource")
     * )
     */
    public $collects = EventSchedulesResource::class;
}
