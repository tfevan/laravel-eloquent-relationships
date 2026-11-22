<?php

declare(strict_types=1);

namespace App\Actions\Car;

use App\Exceptions\ResourceConflictException;
use App\Models\Car;
use App\Models\Owner;

class CreateCarOwner
{
    /**
     * Create the owner of a car, this is how a mechanic gets an owner through the car.
     */
    public function execute(Car $car, array $data): Owner
    {
        if ($car->owner()->exists()) {
            throw new ResourceConflictException('The car already has an owner.');
        }

        return $car->owner()->create($data);
    }
}