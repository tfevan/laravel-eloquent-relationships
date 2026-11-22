<?php

declare(strict_types=1);

namespace App\Actions\Phone;

use App\Models\Phone;
use App\Models\User;

class CheckPhoneOwner
{
    /**
     * Check if the user owns the phone with is().
     */
    public function execute(Phone $phone, User $user): bool
    {
        return $phone->user()->is($user);
    }
}