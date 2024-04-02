<?php

namespace Tests\Unit\CalendarEvent\Services;

use Tests\TestCase;
use App\Modules\CalendarEvent\Collections\EventScheduleDTOCollection;
use App\Modules\CalendarEvent\DTOs\CalendarEventDTO;
use App\Modules\CalendarEvent\Enums\FrequencyEnum;
use App\Modules\CalendarEvent\Services\GetRecurringDatesService;

class GetRecurringDatesServiceTest extends TestCase
{
    public function testInvokeWithNonRecurringEvent()
    {
        //Arrange
        $calendarEventDTO = new CalendarEventDTO(
            start: '2023-04-01',
            end: '2023-04-01',
            recurring: false,
            frequency: null,
            repeatUntil: null
        );

        $sut = new GetRecurringDatesService();

        //ACT
        $result = $sut($calendarEventDTO);

        //ASSERT
        $this->assertInstanceOf(EventScheduleDTOCollection::class, $result);
        $this->assertCount(1, $result->all());
    }

    public function testInvokeWithRecurringEvent()
    {
        //Arrange
        $calendarEventDTO = new CalendarEventDTO(
            start: '2023-04-01',
            end: '2023-04-01',
            recurring: true,
            frequency: FrequencyEnum::DAILY->value,
            repeatUntil: '2023-04-03'
        );

        $sut = new GetRecurringDatesService();

        //ACT
        $result = $sut($calendarEventDTO);

        //ASSERT
        $this->assertInstanceOf(EventScheduleDTOCollection::class, $result);
        $this->assertCount(3, $result->all());
    }
}
