<?php

namespace App\Modules\CalendarEvent\Rules;

use App\Modules\CalendarEvent\Enums\FrequencyEnum;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Carbon;

class ValidFrequencyDateRule implements ValidationRule
{
    public function __construct(private bool $recurring,private string $frequency)
    {
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $startDate = Carbon::createFromFormat('Y-m-d', request('start'));
        $endDate = Carbon::createFromFormat('Y-m-d', $value);
        if ($this->recurring) {
            $this->validateFrequncyDates($startDate, $endDate, $fail);
        }
    }

    /**
     * @param Carbon|null $startDate
     * @param Carbon|null $endDate
     * @param Closure $fail
     * @return void
     */
    public function validateFrequncyDates(?Carbon $startDate, ?Carbon $endDate, Closure $fail): void
    {
        switch ($this->frequency) {
            case FrequencyEnum::DAILY->value:
                if ($startDate->toDateString() != $endDate->toDateString()) {
                    $fail('For Daily Frequency, Start and End date should be in same day');
                }
            case FrequencyEnum::WEEKLY->value:
                if ($startDate->startOfWeek()->toDateString() != $endDate->startOfWeek()->toDateString()) {
                    $fail('For Weekly Frequency, Start and End date should be in same Week');
                }
            case FrequencyEnum::MONTHLY->value:
                if ($startDate->format('Y-m') != $endDate->format('Y-m')) {
                    $fail('For Monthly Frequency, Start and End date should be in same Month');
                }
            case FrequencyEnum::YEARLY->value:
                if ($startDate->format('Y') != $endDate->format('Y')) {
                    $fail('For Yearly Frequency, Start and End date should be in same Year');
                }
        }
    }
}
