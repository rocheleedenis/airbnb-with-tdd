<?php

namespace App\Domain\ValueObjects\Exceptions;

use Exception;

class DateRangeException extends Exception
{
    public function __construct(string $message = '', int $code = 0)
    {
        $message = $message ?: __('validation.date_range.invalid_date_range');

        parent::__construct($message, $code);
    }
}
