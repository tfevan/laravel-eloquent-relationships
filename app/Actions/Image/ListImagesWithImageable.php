<?php

declare(strict_types=1);

namespace App\Actions\Image;

use App\Actions\Concerns\ResolvesImageableType;
use App\Models\Image;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ListImagesWithImageable
{
    use ResolvesImageableType;

    /**
     * List images with the parent eager loaded, optionally only for one imageable type.
     */
    public function execute(?string $type = null): Collection
    {
        if ($type !== null) {
            $this->imageableClass($type);
        }

        return Image::query()
            ->when($type !== null, fn (Builder $query) => $query->where('imageable_type', $type))
            ->with('imageable')
            ->orderBy('id')
            ->get();
    }
}