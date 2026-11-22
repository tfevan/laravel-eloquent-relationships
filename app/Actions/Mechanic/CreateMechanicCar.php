<?php

declare(strict_types=1);

namespace App\Actions\Mechanic;

use App\Exceptions\ResourceConflictException;
use App\Models\Car;
use App\Models\Mechanic;

class CreateMechanicCar
{
    /**
     * Create the intermediate car, a through relationship has no create method of its own.
     */
    public function execute(Mechanic $mechanic, array $data): Car
    {
        if ($mechanic->car()->exists()) {
            throw new ResourceConflictException('The mechanic already has a car.');
        }

        return $mechanic->car()->create($data);
    }
}