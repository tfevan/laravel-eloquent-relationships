<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\Relation;

class SearchUsersByPhoneNumber
{
    /**
     * Find users by a phone number fragment and eager load only the matching phone.
     */
    public function execute(string $number): Collection
    {
        return User::withWhereHas('phone', fn (Builder|Relation $query) => $query->where('number', 'like', "%{$number}%"))
            ->orderBy('id')
            ->get();
    }
}