<?php

namespace App\Domain\Dtos;

use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Data;

class PropertyDto extends Data
{
    public function __construct(
        public string $name,
        public string $description,
        #[Min(1)]
        public int $max_guests,
        #[Min(1)]
        public int $price_per_night,
    ) {}
}
