<?php

namespace Database\Factories;

use App\Models\CalendarEvent;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EventSchedule>
 */
class EventScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('+1 week', '+1 month');
        $end = (clone $start)->modify('+1 month');

        return [
            'start' => $start,
            'end' => $end,
            'calendar_events_id' => CalendarEvent::factory()->create()
        ];
    }
}
