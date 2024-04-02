<?php

namespace App\Modules\CalendarEvent\Services;

use App\Models\EventSchedule;
use App\Modules\CalendarEvent\Collections\EventScheduleDTOCollection;
use App\Modules\CalendarEvent\DTOs\CalendarEventDTO;
use App\Modules\CalendarEvent\DTOs\EventScheduleDTO;
use App\Modules\CalendarEvent\Enums\FrequencyEnum;
use App\Modules\CalendarEvent\Interfaces\GetRecurringDatesServiceInterface;
use Illuminate\Support\Carbon;

class GetRecurringDatesService implements GetRecurringDatesServiceInterface
{
    public function __invoke(CalendarEventDTO $calendarEventDTO): EventScheduleDTOCollection
    {
        $eventScheduleDTOCollection = new EventScheduleDTOCollection();
        if (!$calendarEventDTO->recurring) {
            $eventScheduleDTOCollection->add(new EventScheduleDTO(
                $calendarEventDTO->start,
                $calendarEventDTO->end
            ));
        } else {
            $eventScheduleDTOCollection = $this->generateEventSchedules($calendarEventDTO);
        }

        return $eventScheduleDTOCollection;
    }

    private function generateEventSchedules(
        CalendarEventDTO $calendarEventDTO
    ): EventScheduleDTOCollection {
        $schedules = new EventScheduleDTOCollection();
        $startDate = Carbon::parse($calendarEventDTO->start);
        $endDate = Carbon::parse($calendarEventDTO->end);
        $repeatUntilDate = Carbon::parse($calendarEventDTO->repeatUntil);

        while ($startDate->lessThanOrEqualTo($repeatUntilDate)) {
            $schedules->add(new EventSchedule(
                [
                    'start' => $startDate->format('Y-m-d'),
                    'end' => $endDate->format('Y-m-d')
                ]
            ));

            switch ($calendarEventDTO->frequency) {
                case FrequencyEnum::DAILY->value:
                    $startDate->addDay();
                    $endDate->addDay();
                    break;
                case FrequencyEnum::WEEKLY->value:
                    $startDate->addWeek();
                    $endDate->addWeek();
                    break;
                case FrequencyEnum::MONTHLY->value:
                    $startDate->addMonth();
                    $endDate->addMonth();
                    break;
                case FrequencyEnum::YEARLY->value:
                    $startDate->addYear();
                    $endDate->addYear();
                    break;
            }
        }

        return $schedules;
    }
}
