<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Models\Phone;
use App\Models\User;

class FirstOrCreateUserPhone
{
    /**
     * Get the existing phone or create it with firstOrCreate().
     */
    public function execute(User $user, array $data): Phone
    {
        return $user->phone()->firstOrCreate([], $data);
    }
}