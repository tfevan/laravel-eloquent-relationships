<?php

declare(strict_types=1);

namespace App\Actions\Mechanic;

use App\Models\Car;
use App\Models\Mechanic;

class ShowMechanicCar
{
    /**
     * Get the intermediate car of the mechanic.
     */
    public function execute(Mechanic $mechanic): ?Car
    {
        return $mechanic->car;
    }
}