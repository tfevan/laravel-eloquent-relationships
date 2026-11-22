<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Exceptions\ResourceNotFoundException;
use App\Models\User;

class DeleteUserPhone
{
    /**
     * Delete the phone of a user through the relation query and return the deleted row count.
     */
    public function execute(User $user): int
    {
        $deleted = $user->phone()->delete();

        if ($deleted === 0) {
            throw new ResourceNotFoundException('The user has no phone.');
        }

        return $deleted;
    }
}