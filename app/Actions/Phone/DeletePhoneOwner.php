<?php

declare(strict_types=1);

namespace App\Actions\Phone;

use App\Models\Phone;

class DeletePhoneOwner
{
    /**
     * Delete the owner of the phone, the foreign key cascade removes the phone too.
     */
    public function execute(Phone $phone): int
    {
        return $phone->user()->delete();
    }
}