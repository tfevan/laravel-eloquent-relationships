<?php

declare(strict_types=1);

namespace App\Actions\Image;

use App\Exceptions\ResourceConflictException;
use App\Models\Image;
use Illuminate\Database\Eloquent\Model;

class CreateImageableImage
{
    /**
     * Create the image of a parent, the imageable_id and imageable_type columns are filled for you.
     */
    public function execute(Model $imageable, array $data): Image
    {
        if ($imageable->image()->exists()) {
            throw new ResourceConflictException('The model already has an image.');
        }

        return $imageable->image()->create($data);
    }
}