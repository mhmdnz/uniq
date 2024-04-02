<?php

namespace Tests\Unit\CalendarEvent\Providers;

use App\Modules\CalendarEvent\Interfaces\DeleteEventSchedulesServiceInterface;
use App\Modules\CalendarEvent\Services\DeleteEventSchedulesService;
use Tests\TestCase;

class DeleteEventSchedulesServiceProviderTest extends TestCase
{
    public function testRepositorySingleton()
    {
        //Arrange
        $sut = resolve(DeleteEventSchedulesServiceInterface::class);

        //Assert
        $this->assertInstanceOf(DeleteEventSchedulesService::class, $sut);
    }
}
