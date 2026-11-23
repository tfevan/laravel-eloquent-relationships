<?php

declare(strict_types=1);

namespace App\Actions\Image;

use App\Exceptions\ResourceConflictException;
use App\Models\Image;
use Illuminate\Database\Eloquent\Model;

class ReassignImage
{
    /**
     * Move the image to another parent with associate(), a parent can own only one image.
     */
    public function execute(Image $image, Model $imageable): Image
    {
        if ($imageable->image()->where('id', '!=', $image->id)->exists()) {
            throw new ResourceConflictException('The new parent already has an image.');
        }

        $image->imageable()->associate($imageable);
        $image->save();

        return $image;
    }
}