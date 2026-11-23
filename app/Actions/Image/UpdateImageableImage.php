<?php

declare(strict_types=1);

namespace App\Actions\Image;

use App\Exceptions\ResourceNotFoundException;
use App\Models\Image;
use Illuminate\Database\Eloquent\Model;

class UpdateImageableImage
{
    /**
     * Update the image of the parent and fail when there is none.
     */
    public function execute(Model $imageable, array $data): Image
    {
        $image = $imageable->image;

        if ($image === null) {
            throw new ResourceNotFoundException('The model has no image.');
        }

        $image->update($data);

        return $image;
    }
}