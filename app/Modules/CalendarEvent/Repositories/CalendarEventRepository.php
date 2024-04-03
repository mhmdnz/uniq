<?php

namespace App\Modules\CalendarEvent\Repositories;

use App\Models\CalendarEvent;
use App\Modules\CalendarEvent\Collections\EventScheduleDTOCollection;
use App\Modules\CalendarEvent\DTOs\CalendarEventDTO;
use App\Modules\CalendarEvent\Interfaces\CalendarEventRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator as LengthAwarePaginatorAlias;

class CalendarEventRepository implements CalendarEventRepositoryInterface
{
    public function createWithEventSchedules(
        EventScheduleDTOCollection $eventScheduleDTOCollection,
        ?CalendarEventDTO $calendarEventDTO = null,
        ?int $calendarEventId = 0
    ): CalendarEvent {
        if ($calendarEventId == 0) {
            $calendarEvent = CalendarEvent::create([
                'title' => $calendarEventDTO->title,
                'description' => $calendarEventDTO->description
            ]);
        } else {
            $calendarEvent = CalendarEvent::find($calendarEventId);
        }
        $calendarEvent->eventSchedules()->saveMany($eventScheduleDTOCollection->all());

        return $calendarEvent->load('eventSchedules');
    }

    public function getAll(): LengthAwarePaginatorAlias
    {
        return CalendarEvent::with('eventSchedules')->paginate(config('app.pagination_counts'));
    }

    public function updateData(int $id, ?string $title, ?string $description): CalendarEvent
    {
        $calendarEvent = CalendarEvent::find($id);
        $dataToUpdate = array_filter([
            'title' => $title,
            'description' => $description,
        ], function ($value) {
            return !is_null($value);
        });

        if (!empty($dataToUpdate)) {
            $calendarEvent->update($dataToUpdate);
        }

        return $calendarEvent->refresh();
    }

    public function deleteById(int $id): void
    {
        $calendarEvent = CalendarEvent::find($id);
        $calendarEvent->delete();
    }
}
