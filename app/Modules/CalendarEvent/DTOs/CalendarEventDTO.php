<?php

namespace App\Modules\CalendarEvent\DTOs;

use App\Modules\CalendarEvent\Enums\FrequencyEnum;
use Illuminate\Support\Facades\Date;

class CalendarEventDTO
{
    public function __construct(
        public ?string $title = null,
        public ?string $start = null,
        public ?string $end = null,
        public ?string $description = null,
        public ?bool $recurring = false,
        public ?string $frequency = null,
        public ?string $repeatUntil = null
    ) {}
}
