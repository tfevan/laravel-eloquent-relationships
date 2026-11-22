<?php

declare(strict_types=1);

namespace App\Actions\Phone;

use App\Exceptions\ResourceNotFoundException;
use App\Models\Phone;
use App\Models\User;

class UpdatePhoneOwner
{
    /**
     * Update the owner of the phone through the child relation.
     */
    public function execute(Phone $phone, array $data): User
    {
        if (! $phone->user()->exists()) {
            throw new ResourceNotFoundException('The phone has no owner.');
        }

        $phone->user()->update($data);

        return $phone->user()->firstOrFail();
    }
}