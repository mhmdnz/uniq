<?php

namespace App\Modules\CalendarEvent\DTOs;

use App\Modules\CalendarEvent\Enums\FrequencyEnum;
use Illuminate\Support\Facades\Date;

class CalendarEventDTO
{
    public function __construct(
        public ?string $title,
        public ?string $start,
        public ?string $end,
        public ?string $description,
        public ?bool $recurring = false,
        public ?string $frequency = null,
        public ?string $repeatUntil = null
    ) {}
}
