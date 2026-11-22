<?php

declare(strict_types=1);

namespace App\Actions\Phone;

use App\Models\Phone;

class DeletePhone
{
    /**
     * Delete the phone itself and keep its owner.
     */
    public function execute(Phone $phone): bool
    {
        return (bool) $phone->delete();
    }
}