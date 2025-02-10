<?php

namespace App\Domain\ValueObjects;

use App\Domain\ValueObjects\Exceptions\DateRangeException;
use Carbon\Carbon;

class DateRange
{
    public function __construct(
        private readonly Carbon $startDate,
        private readonly Carbon $endDate,
    ) {
        $this->validate();
    }

    public function getTotalNights(): int
    {
        return $this->startDate->diffInDays($this->endDate);
    }

    public function overlaps(self $other): bool
    {
        return $this->startDate->lessThan($other->endDate)
            && $this->endDate->greaterThan($other->startDate);
    }

    private function validate(): void
    {
        if ($this->startDate->greaterThanOrEqualTo($this->endDate)) {
            throw new DateRangeException(__('validation.date_range.invalid_date_range'));
        }
    }
}
