<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Exceptions\ResourceConflictException;
use App\Models\Phone;
use App\Models\User;

class CreateUserPhone
{
    /**
     * Create the phone of a user with create().
     */
    public function execute(User $user, array $data): Phone
    {
        if ($user->phone()->exists()) {
            throw new ResourceConflictException('The user already has a phone.');
        }

        return $user->phone()->create($data);
    }
}