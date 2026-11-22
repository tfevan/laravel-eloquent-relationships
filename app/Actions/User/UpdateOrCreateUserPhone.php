<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Models\Phone;
use App\Models\User;

class UpdateOrCreateUserPhone
{
    /**
     * Update the phone or create it when missing with updateOrCreate().
     */
    public function execute(User $user, array $data): Phone
    {
        return $user->phone()->updateOrCreate([], $data);
    }
}