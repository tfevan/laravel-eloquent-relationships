<?php

declare(strict_types=1);

namespace App\Actions\Image;

use Illuminate\Database\Eloquent\Model;

class CheckImageableHasImage
{
    /**
     * Check if the parent has an image without loading it.
     */
    public function execute(Model $imageable): bool
    {
        return $imageable->image()->exists();
    }
}