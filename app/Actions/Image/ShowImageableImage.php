<?php

declare(strict_types=1);

namespace App\Actions\Image;

use App\Models\Image;
use Illuminate\Database\Eloquent\Model;

class ShowImageableImage
{
    /**
     * Get the image of a user or a post through the dynamic property.
     */
    public function execute(Model $imageable): ?Image
    {
        return $imageable->image;
    }
}