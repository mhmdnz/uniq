<?php

namespace Tests\Unit\CalendarEvent\Providers;

use App\Modules\CalendarEvent\Interfaces\EventScheduleRepositoryInterface;
use App\Modules\CalendarEvent\Repositories\EventScheduleRepository;
use Tests\TestCase;

class EventScheduleRepositoryProviderTest extends TestCase
{
    public function testRepositorySingleton()
    {
        //Arrange
        $sut = resolve(EventScheduleRepositoryInterface::class);

        //Assert
        $this->assertInstanceOf(EventScheduleRepository::class, $sut);
    }
}
