<?php
namespace App\Modules\CalendarEvent\Collections;

use App\Models\EventSchedule;
use Illuminate\Support\Collection;
class EventScheduleDTOCollection
{
    private Collection $items;

    public function __construct(EventSchedule ...$eventSchedule)
    {
        $this->items = collect($eventSchedule);
    }

    public function add(EventSchedule $eventSchedule): void
    {
        $this->items->push($eventSchedule);
    }

    public function all(): Collection
    {
        return $this->items;
    }
}
