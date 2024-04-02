<?php

namespace Tests\Unit\CalendarEvent\Providers;

use Tests\TestCase;
use App\Modules\CalendarEvent\Interfaces\CalendarEventRepositoryInterface;
use App\Modules\CalendarEvent\Providers\CalendarEventRepositoryProvider;
use App\Modules\CalendarEvent\Repositories\CalendarEventRepository;
use Illuminate\Container\Container;

class CalendarEventRepositoryProviderTest extends TestCase
{
    public function testRepositorySingleton()
    {
        //Arrange
        $container = new Container();

        //ACT
        $provider = new CalendarEventRepositoryProvider($container);
        $provider->register();

        $resolved = $container->make(CalendarEventRepositoryInterface::class);
        $secondResolved = $container->make(CalendarEventRepositoryInterface::class);

        //Assert
        $this->assertInstanceOf(CalendarEventRepository::class, $resolved);
        $this->assertSame($resolved, $secondResolved, 'The same instance should be resolved on subsequent calls.');
    }
}
