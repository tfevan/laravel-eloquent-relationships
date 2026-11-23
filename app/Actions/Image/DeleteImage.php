<?php

declare(strict_types=1);

namespace App\Actions\Image;

use App\Models\Image;

class DeleteImage
{
    /**
     * Delete the image itself and keep its parent.
     */
    public function execute(Image $image): bool
    {
        return (bool) $image->delete();
    }
}