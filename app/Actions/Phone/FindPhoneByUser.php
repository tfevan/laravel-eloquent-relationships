<?php

declare(strict_types=1);

namespace App\Actions\Phone;

use App\Models\Phone;
use App\Models\User;

class FindPhoneByUser
{
    /**
     * Find the phone of a user from the phone side with whereBelongsTo().
     */
    public function execute(User $user): ?Phone
    {
        return Phone::whereBelongsTo($user)->first();
    }
}