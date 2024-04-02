<?php

/**
 * @OA\Schema(
 *     title="CalendarEventCollection",
 *     description="Calendar event collection",
 *     @OA\Xml(name="CalendarEventCollection")
 * )
 */
namespace App\Modules\CalendarEvent\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CalendarEventCollection extends ResourceCollection
{
    /**
     * @OA\Property(
     *     property="data",
     *     type="array",
     *     @OA\Items(ref="#/components/schemas/CalendarEventResource")
     * )
     */
    public $collects = CalendarEventResource::class;
}
