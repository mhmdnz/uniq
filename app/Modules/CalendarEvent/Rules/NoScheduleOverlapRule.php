<?php

namespace App\Modules\CalendarEvent\Rules;

use App\Modules\CalendarEvent\DTOs\CalendarEventDTO;
use App\Modules\CalendarEvent\Interfaces\EventScheduleRepositoryInterface;
use App\Modules\CalendarEvent\Interfaces\GetRecurringDatesServiceInterface;
use Illuminate\Contracts\Validation\ValidationRule;
use Closure;
use Illuminate\Foundation\Http\FormRequest;

class NoScheduleOverlapRule implements ValidationRule
{

    public function __construct(
        private FormRequest $formRequest,
    ) {
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $calendarEventDTO = new CalendarEventDTO(
            title: $this->formRequest->title,
            start: $this->formRequest->start,
            end: $this->formRequest->end,
            description: $this->formRequest->description,
            recurring: $this->formRequest->recurring ?? false,
            frequency: $this->formRequest->frequency ?? null,
            repeatUntil: $this->formRequest->repeat_until ?? null,
        );

        $service = resolve(GetRecurringDatesServiceInterface::class);
        try {
            $schedules = $service($calendarEventDTO);
            /**
             * @var EventScheduleRepositoryInterface $eventScheduleRepository
             */
            $eventScheduleRepository = resolve(EventScheduleRepositoryInterface::class);
            foreach ($schedules->all() as $schedule) {
                $conflicts = ($eventScheduleRepository)->getByDate(
                    $schedule->start,
                    $schedule->end
                );

                if ($conflicts) {
                    $calendarEvent = $eventScheduleRepository->getCalendarEvent($conflicts[0]->calendar_event_id);
                    $fail('we have conflict this event title : ' . $calendarEvent->title);
                }
            }
        } catch (\Exception) {
            //todo: should be log here
        }
    }
}
