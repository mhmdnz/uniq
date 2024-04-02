<?php

namespace Tests\Unit\CalendarEvent\Rules;

use App\Models\CalendarEvent;
use App\Models\EventSchedule;
use Tests\TestCase;
use App\Modules\CalendarEvent\Collections\EventScheduleDTOCollection;
use App\Modules\CalendarEvent\DTOs\EventScheduleDTO;
use App\Modules\CalendarEvent\Interfaces\EventScheduleRepositoryInterface;
use App\Modules\CalendarEvent\Interfaces\GetRecurringDatesServiceInterface;
use App\Modules\CalendarEvent\Rules\NoScheduleOverlapRule;
use Illuminate\Foundation\Http\FormRequest;
use Mockery;

class NoScheduleOverlapRuleTest extends TestCase
{
    public function testValidateWithNoOverlap()
    {
        $formRequest = resolve(FormRequest::class);
        $getRecurringDatesService = Mockery::mock(GetRecurringDatesServiceInterface::class);
        $eventScheduleRepository = Mockery::mock(EventScheduleRepositoryInterface::class);

        $app = app();
        $app->instance(GetRecurringDatesServiceInterface::class, $getRecurringDatesService);
        $app->instance(EventScheduleRepositoryInterface::class, $eventScheduleRepository);

        $getRecurringDatesService->shouldReceive('__invoke')
            ->andReturn(new EventScheduleDTOCollection(new EventScheduleDTO('2023-01-01', '2023-01-02')));
        $eventScheduleRepository->shouldReceive('getByDate')->andReturn(collect());
        $rule = new NoScheduleOverlapRule($formRequest);

        $valid = true;
        $rule->validate('event_schedules', null, function ($message) use (&$valid) {
            $valid = false;
        });

        $this->assertTrue($valid, 'Expected no validation failure');
    }

    public function testValidateWithOverlap()
    {
        $formRequest = resolve(FormRequest::class);

        $eventScheduleCollection = new EventScheduleDTOCollection();
        $eventScheduleDTO = new EventScheduleDTO('2023-01-01', '2023-01-02'); // Replace with appropriate constructor arguments
        $eventScheduleCollection->add($eventScheduleDTO);

        $getRecurringDatesServiceMock = Mockery::mock(GetRecurringDatesServiceInterface::class);
        $getRecurringDatesServiceMock
            ->shouldReceive('__invoke')
            ->andReturn($eventScheduleCollection);

        $eventScheduleRepositoryMock = Mockery::mock(EventScheduleRepositoryInterface::class);

        $eventSchedule = EventSchedule::factory(2)->make();
        $calendarEvent = CalendarEvent::factory()->make();

        $eventScheduleRepositoryMock
            ->shouldReceive('getByDate')
            ->once()
            ->andReturn($eventSchedule);

        $eventScheduleRepositoryMock
            ->shouldReceive('getCalendarEvent')
            ->once()
            ->andReturn($calendarEvent);

        $app = app();
        $app->instance(GetRecurringDatesServiceInterface::class, $getRecurringDatesServiceMock);
        $app->instance(EventScheduleRepositoryInterface::class, $eventScheduleRepositoryMock);
        $rule = new NoScheduleOverlapRule($formRequest);

        $rule->validate('event_schedules', null, function ($message) use (&$failMessage) {
            $failMessage = $message;
        });
    }
}
