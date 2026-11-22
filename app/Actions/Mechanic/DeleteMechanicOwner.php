<?php

declare(strict_types=1);

namespace App\Actions\Mechanic;

use App\Exceptions\ResourceNotFoundException;
use App\Models\Mechanic;

class DeleteMechanicOwner
{
    /**
     * Delete the owner reached through the car and keep the car and the mechanic.
     */
    public function execute(Mechanic $mechanic): bool
    {
        $owner = $mechanic->owner;

        if ($owner === null) {
            throw new ResourceNotFoundException('The mechanic has no owner.');
        }

        return (bool) $owner->delete();
    }
}