<?php

declare(strict_types=1);

namespace App\Actions\Image;

use App\Exceptions\ResourceNotFoundException;
use Illuminate\Database\Eloquent\Model;

class DeleteImageableImage
{
    /**
     * Delete the image of the parent and keep the parent.
     */
    public function execute(Model $imageable): bool
    {
        $image = $imageable->image;

        if ($image === null) {
            throw new ResourceNotFoundException('The model has no image.');
        }

        return (bool) $image->delete();
    }
}