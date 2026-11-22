<?php

declare(strict_types=1);

namespace App\Actions\Mechanic;

use App\Models\Mechanic;
use App\Models\Owner;

class ShowMechanicOwnerFluently
{
    /**
     * Get the owner with the fluent through() syntax instead of a hasOneThrough method.
     */
    public function execute(Mechanic $mechanic): ?Owner
    {
        return $mechanic->through('car')->has('owner')->first();
    }
}