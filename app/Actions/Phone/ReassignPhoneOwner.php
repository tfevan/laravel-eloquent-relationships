<?php

declare(strict_types=1);

namespace App\Actions\Phone;

use App\Models\Phone;

class ReassignPhoneOwner
{
    /**
     * Move the phone to another user with associate().
     */
    public function execute(Phone $phone, int $userId): Phone
    {
        $phone->user()->associate($userId);
        $phone->save();

        return $phone->load('user');
    }
}