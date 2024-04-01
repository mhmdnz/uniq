<?php

namespace App\Models;

use Database\Factories\EventScheduleFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;

/**
 * Class EventSchedule
 * @package App\Models
 * @property int id
 * @property Date start
 * @property Date end
 * @property Carbon created_at
 * @property Carbon updated_at
 *
 * @property CalendarEvent calendarEvent
 * @method static EventScheduleFactory factory($count = null, $state = [])
 */
class EventSchedule extends Model
{
    use HasFactory;

    public function calendarEvent(): BelongsTo
    {
        return $this->belongsTo(CalendarEvent::class);
    }
}
