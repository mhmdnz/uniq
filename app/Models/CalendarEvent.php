<?php

namespace App\Models;

use Database\Factories\CalendarEventFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * Class CalendarEvent
 * @package App\Models
 * @property int id
 * @property string title
 * @property string description
 * @property Carbon created_at
 * @property Carbon updated_at
 *
 * @property Collection eventSchedules
 * @method static CalendarEventFactory factory($count = null, $state = [])
 */
class CalendarEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description'
    ];

    public function eventSchedules(): HasMany
    {
        return $this->hasMany(EventSchedule::class);
    }
}
