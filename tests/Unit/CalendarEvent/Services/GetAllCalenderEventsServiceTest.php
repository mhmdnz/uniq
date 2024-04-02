<?php

namespace Tests\Unit\CalendarEvent\Services;

use Tests\TestCase;
use App\Modules\CalendarEvent\Services\GetAllCalenderEventsService;
use App\Modules\CalendarEvent\Repositories\CalendarEventRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator as LengthAwarePaginatorAlias;
use Mockery;

class GetAllCalenderEventsServiceTest extends TestCase
{
    public function testInvokeReturnsAllCalendarEventsSuccessfully()
    {
        //Arrange
        $calendarEventRepositoryMock = Mockery::mock(CalendarEventRepository::class);
        $sut = new GetAllCalenderEventsService($calendarEventRepositoryMock);

        $lengthAwarePaginatorMock = Mockery::mock(LengthAwarePaginatorAlias::class);

        $calendarEventRepositoryMock
            ->shouldReceive('getAll')
            ->once()
            ->andReturn($lengthAwarePaginatorMock);

        //ACT
        $result = $sut();

        //ASSERT
        $this->assertInstanceOf(LengthAwarePaginatorAlias::class, $result);
    }
}
