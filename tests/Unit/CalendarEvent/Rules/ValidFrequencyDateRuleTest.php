<?php

namespace Tests\Unit\CalendarEvent\Rules;

use Tests\TestCase;
use App\Modules\CalendarEvent\Enums\FrequencyEnum;
use App\Modules\CalendarEvent\Rules\ValidFrequencyDateRule;
use Illuminate\Support\Carbon;

class ValidFrequencyDateRuleTest extends TestCase
{
    public function testValidDailyFrequency()
    {
        $rule = new ValidFrequencyDateRule(true, FrequencyEnum::DAILY->value);
        $valid = true; // Assume validation passes by default

        $rule->validate('end', Carbon::now()->format('Y-m-d'), function ($message) use (&$valid) {
            $valid = false; // Validation failed
        });

        $this->assertTrue($valid);
    }

    public function testInvalidDailyFrequency()
    {
        $rule = new ValidFrequencyDateRule(true, FrequencyEnum::DAILY->value);
        $valid = true; // Assume validation passes by default

        $rule->validate('end', Carbon::now()->addDay()->format('Y-m-d'), function ($message) use (&$valid) {
            $valid = false; // Validation failed
        });

        $this->assertFalse($valid);
    }

    public function testValidWeeklyFrequency()
    {
        $rule = new ValidFrequencyDateRule(true, FrequencyEnum::WEEKLY->value);
        $valid = true; // Assume validation passes by default

        $rule->validate('end', Carbon::now()->startOfWeek()->format('Y-m-d'), function ($message) use (&$valid) {
            $valid = false; // Validation failed
        });

        $this->assertTrue($valid);
    }

    public function testValidMonthlyFrequency()
    {
        $rule = new ValidFrequencyDateRule(true, FrequencyEnum::MONTHLY->value);
        $valid = true; // Assume validation passes by default

        $rule->validate('end', Carbon::now()->format('Y-m-d'), function ($message) use (&$valid) {
            $valid = false; // Validation failed
        });

        $this->assertTrue($valid);
    }

    public function testValidYearlyFrequency()
    {
        $rule = new ValidFrequencyDateRule(true, FrequencyEnum::YEARLY->value);
        $valid = true; // Assume validation passes by default

        $rule->validate('end', Carbon::now()->format('Y-m-d'), function ($message) use (&$valid) {
            $valid = false; // Validation failed
        });

        $this->assertTrue($valid);
    }

    protected function setUp(): void
    {
        parent::setUp();

        // Mock request() helper function within the test namespace
        $start = Carbon::now()->format('Y-m-d');
        $this->start = $start;

        app()->bind('request', function () use ($start) {
            $mock = \Mockery::mock(\Illuminate\Http\Request::class);
            $mock->shouldReceive('all')->andReturn();
            $mock->shouldReceive('route')->andReturn($start);
            return $mock;
        });
    }

    protected function tearDown(): void
    {
        \Mockery::close();
        parent::tearDown();
    }
}
