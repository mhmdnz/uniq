<?php

namespace App\Modules\CalendarEvent\Interfaces;

use App\Models\CalendarEvent;
use App\Modules\CalendarEvent\Collections\EventScheduleDTOCollection;
use App\Modules\CalendarEvent\DTOs\CalendarEventDTO;
use Illuminate\Contracts\Pagination\LengthAwarePaginator as LengthAwarePaginatorAlias;
use Illuminate\Support\Collection;

interface CalendarEventRepositoryInterface
{
    public function createWithEventSchedules(
        EventScheduleDTOCollection $eventScheduleDTOCollection,
        ?CalendarEventDTO $calendarEventDTO = null,
        ?int $calendarEventId = null
    ): CalendarEvent;

    public function getAll(): LengthAwarePaginatorAlias;

    public function updateData(int $id, ?string $title, ?string $description): CalendarEvent;

    public function deleteById(int $id): void;
}
