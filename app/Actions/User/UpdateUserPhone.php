<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Exceptions\ResourceNotFoundException;
use App\Models\Phone;
use App\Models\User;

class UpdateUserPhone
{
    /**
     * Update the existing phone through the relation query.
     */
    public function execute(User $user, array $data): Phone
    {
        if (! $user->phone()->exists()) {
            throw new ResourceNotFoundException('The user has no phone.');
        }

        $user->phone()->update($data);

        return $user->phone()->firstOrFail();
    }
}