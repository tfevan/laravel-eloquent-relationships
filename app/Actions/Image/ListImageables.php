<?php

declare(strict_types=1);

namespace App\Actions\Image;

use App\Actions\Concerns\ResolvesImageableType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ListImageables
{
    use ResolvesImageableType;

    /**
     * List users or posts with their image, optionally only those with or without one.
     */
    public function execute(string $type, ?bool $hasImage = null): Collection
    {
        return $this->imageableClass($type)::query()
            ->when($hasImage === true, fn (Builder $query) => $query->has('image'))
            ->when($hasImage === false, fn (Builder $query) => $query->doesntHave('image'))
            ->with('image')
            ->orderBy('id')
            ->get();
    }
}