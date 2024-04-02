<?php

/**
 * @OA\OpenApi(
 *   @OA\Components(
 *     @OA\Schema(
 *       schema="AddCalendarEventRequest",
 *       required={"title", "start", "end"},
 *       @OA\Property(
 *         property="title",
 *         type="string",
 *         maxLength=255,
 *         description="Title of the calendar event",
 *       ),
 *       @OA\Property(
 *         property="description",
 *         type="string",
 *         maxLength=255,
 *         description="Description of the calendar event",
 *       ),
 *       @OA\Property(
 *         property="start",
 *         type="string",
 *         format="date",
 *         description="Start date of the event",
 *       ),
 *       @OA\Property(
 *         property="end",
 *         type="string",
 *         format="date",
 *         description="End date of the event, must be after or equal to the start date",
 *       ),
 *       @OA\Property(
 *         property="recurring",
 *         type="boolean",
 *         description="Indicates if the event is recurring",
 *       ),
 *       @OA\Property(
 *         property="frequency",
 *         type="string",
 *         description="Frequency of the event if it is recurring",
 *       ),
 *       @OA\Property(
 *         property="repeat_until",
 *         type="string",
 *         format="date",
 *         description="The date until which a recurring event should repeat",
 *       ),
 *     )
 *   )
 * )
 */
namespace App\Modules\CalendarEvent\Requests;

use App\Modules\CalendarEvent\Enums\FrequencyEnum;
use App\Modules\CalendarEvent\Rules\NoScheduleOverlapRule;
use App\Modules\CalendarEvent\Rules\ValidFrequencyDateRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddCalendarEventRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'max:255'],
            'description' => ['max:255'],
            'start' => ['bail', 'required', 'date_format:Y-m-d'],
            'end' => ['bail', 'required', 'date_format:Y-m-d', 'after_or_equal:start',  new ValidFrequencyDateRule(
                $this->recurring,
                $this->frequency
            )],
            'recurring' => ['bool'],
            'frequency' => ['bail', 'required_if:recurring,==,true', Rule::enum(FrequencyEnum::class)],
            'repeat_until' => ['bail', 'after_or_equal:end', 'required_if:recurring,==,true', 'date', new NoScheduleOverlapRule($this)]
        ];
    }
}
