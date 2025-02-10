<?php

namespace Tests\Unit;

use App\Domain\ValueObjects\DateRange;
use App\Domain\ValueObjects\Exceptions\DateRangeException;
use Carbon\Carbon;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class DateRangeTest extends TestCase
{
    public function test_it_creates_a_new_class_correctly(): void
    {
        $dateRange = new DateRange(
            Carbon::parse('2025-02-01'),
            Carbon::parse('2025-02-06'),
        );

        $this->assertInstanceOf(DateRange::class, $dateRange);
    }

    public function test_it_handles_invalid_date_range(): void
    {
        $this->expectException(DateRangeException::class);
        $this->expectExceptionMessage(__('validation.date_range.invalid_date_range'));
        $this->expectExceptionCode(0);

        new DateRange(
            Carbon::parse('2025-02-06'),
            Carbon::parse('2025-02-01'),
        );
    }

    public function test_it_handles_equal_dates_for_range(): void
    {
        $this->expectException(DateRangeException::class);
        $this->expectExceptionMessage(__('validation.date_range.invalid_date_range'));
        $this->expectExceptionCode(0);

        new DateRange(
            Carbon::parse('2025-02-06'),
            Carbon::parse('2025-02-06'),
        );
    }

    public function test_it_calculates_the_total_nights_correctly(): void
    {
        $dateRange = new DateRange(
            Carbon::parse('2025-02-01'),
            Carbon::parse('2025-02-06'),
        );

        $this->assertEquals(5, $dateRange->getTotalNights());
    }

    #[DataProvider('overlapProvider')]
    public function test_it_checks_if_two_date_ranges_overlap($date1, $date2, $date3, $date4, $return): void
    {
        $dateRange1 = new DateRange(Carbon::parse($date1), Carbon::parse($date2));
        $dateRange2 = new DateRange(Carbon::parse($date3), Carbon::parse($date4));

        $assertion = $return ? 'assertTrue' : 'assertFalse';

        $this->$assertion($dateRange1->overlaps($dateRange2));
    }

    public static function overlapProvider(): array
    {
        return [
            [
                '2025-02-01',
                '2025-02-06',
                '2025-02-05',
                '2025-02-10',
                true,
            ],
            [
                '2025-02-01',
                '2025-02-06',
                '2025-02-07',
                '2025-02-10',
                false,
            ],
            [
                '2025-02-05',
                '2025-02-10',
                '2025-02-01',
                '2025-02-06',
                true,
            ],
        ];
    }
}
