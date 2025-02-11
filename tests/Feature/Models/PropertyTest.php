<?php

namespace Tests\Feature\Models;

use App\Exceptions\PropertyException;
use App\Models\Property;
use Tests\TestCase;

class PropertyTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_it_throws_exception_when_validate_guests_quantity(): void
    {
        $this->expectException(PropertyException::class);
        $this->expectExceptionMessage('The number of guests exceeds the maximum allowed');

        $property = Property::factory()->make([
            'max_guests' => 5,
        ]);

        $property->validateGuestsQuantity(6);
    }
}
