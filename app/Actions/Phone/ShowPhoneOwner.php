<?php

declare(strict_types=1);

namespace App\Actions\Phone;

use App\Models\Phone;
use App\Models\User;

class ShowPhoneOwner
{
    /**
     * Get the owner of a phone through the dynamic property.
     */
    public function execute(Phone $phone): ?User
    {
        return $phone->user;
    }
}