<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ListUsersWithPhone
{
    /**
     * List users with the phone eager loaded, optionally only those with or without a phone.
     */
    public function execute(?bool $hasPhone = null): Collection
    {
        return User::query()
            ->when($hasPhone === true, fn (Builder $query) => $query->has('phone'))
            ->when($hasPhone === false, fn (Builder $query) => $query->doesntHave('phone'))
            ->with('phone')
            ->orderBy('id')
            ->get();
    }
}