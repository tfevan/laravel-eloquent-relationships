<?php

declare(strict_types=1);

namespace App\Actions\Mechanic;

use App\Exceptions\ResourceNotFoundException;
use App\Models\Mechanic;
use App\Models\Owner;

class UpdateMechanicOwner
{
    /**
     * Update the owner reached through the car by fetching the model first.
     */
    public function execute(Mechanic $mechanic, array $data): Owner
    {
        $owner = $mechanic->owner;

        if ($owner === null) {
            throw new ResourceNotFoundException('The mechanic has no owner.');
        }

        $owner->update($data);

        return $owner;
    }
}