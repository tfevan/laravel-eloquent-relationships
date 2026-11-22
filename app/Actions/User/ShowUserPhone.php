<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Models\Phone;
use App\Models\User;

class ShowUserPhone
{
    /**
     * Get the phone of a user through the dynamic property.
     */
    public function execute(User $user): ?Phone
    {
        return $user->phone;
    }
}