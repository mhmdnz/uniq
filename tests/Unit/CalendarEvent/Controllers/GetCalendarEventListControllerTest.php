<?php

namespace Tests\Unit\CalendarEvent\Controllers;

use App\Modules\CalendarEvent\Controllers\GetCalendarEventListController;
use App\Modules\CalendarEvent\Interfaces\GetAllCalendarEventsServiceInterface;
use App\Modules\CalendarEvent\Resources\CalendarEventCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use Mockery;
use Tests\TestCase;

class GetCalendarEventListControllerTest extends TestCase
{
    public function testInvoke()
    {
        // Arrange
        $service = Mockery::mock(GetAllCalendarEventsServiceInterface::class);
        $controller = new GetCalendarEventListController($service);
        $items = collect([]);
        $total = 0;
        $perPage = 15;
        $current_page = 1;
        $options = [];

        $paginatorMock = Mockery::mock(LengthAwarePaginator::class, [$items, $total, $perPage, $current_page, $options])
            ->makePartial();
        $service->shouldReceive('__invoke')
            ->once()
            ->andReturn($paginatorMock);

        // ACT
        $response = $controller();

        // Assert
        $this->assertInstanceOf(CalendarEventCollection::class, $response);
    }
}
