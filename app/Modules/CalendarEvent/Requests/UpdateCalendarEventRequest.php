<?php

/**
 * @OA\Schema(
 *     schema="UpdateCalendarEventRequest",
 *     required={"id"},
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="The ID of the calendar event to update",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="title",
 *         type="string",
 *         maxLength=255,
 *         description="Title of the calendar event",
 *         example="Updated Event Title"
 *     ),
 *     @OA\Property(
 *         property="description",
 *         type="string",
 *         maxLength=255,
 *         description="Description of the calendar event",
 *         example="Updated Event Description"
 *     ),
 *     @OA\Property(
 *         property="start",
 *         type="string",
 *         format="date",
 *         description="Start date of the event",
 *         example="2024-01-01"
 *     ),
 *     @OA\Property(
 *         property="end",
 *         type="string",
 *         format="date",
 *         description="End date of the event, which must be after or equal to the start date",
 *         example="2024-01-02"
 *     ),
 *     @OA\Property(
 *         property="recurring",
 *         type="boolean",
 *         description="Indicates if the event is recurring",
 *         example=true
 *     ),
 *     @OA\Property(
 *         property="frequency",
 *         type="string",
 *         description="The frequency of the event if it is recurring",
 *         enum={"DAILY", "WEEKLY", "MONTHLY", "YEARLY"}
 *     ),
 *     @OA\Property(
 *         property="repeat_until",
 *         type="string",
 *         format="date",
 *         description="The date until which a recurring event should repeat",
 *         example="2024-12-31"
 *     )
 * )
 */
namespace App\Modules\CalendarEvent\Requests;

use App\Modules\CalendarEvent\Enums\FrequencyEnum;
use App\Modules\CalendarEvent\Rules\NoScheduleOverlapRule;
use App\Modules\CalendarEvent\Rules\ValidFrequencyDateRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCalendarEventRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => ['required', Rule::exists('calendar_events', 'id')],
            'title' => ['max:255'],
            'description' => ['max:255'],
            'start' => ['bail', 'date_format:Y-m-d'],
            'end' => [
                'bail',
                'required_with:start',
                'date_format:Y-m-d',
                'after_or_equal:start',
                new ValidFrequencyDateRule(
                    $this->recurring,
                    $this->frequency
                )],
            'recurring' => ['bool'],
            'frequency' => [
                'bail',
                'required_if:recurring,==,true',
                Rule::enum(FrequencyEnum::class)
            ],
            'repeat_until' => [
                'bail',
                'after_or_equal:end',
                'required_if:recurring,==,true',
                'date', new NoScheduleOverlapRule($this)
            ]
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'id' => $this->route('id'),
        ]);
    }
}
