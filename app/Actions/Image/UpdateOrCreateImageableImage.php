<?php

declare(strict_types=1);

namespace App\Actions\Image;

use App\Models\Image;
use Illuminate\Database\Eloquent\Model;

class UpdateOrCreateImageableImage
{
    /**
     * Update the existing image or create it when the parent has none.
     */
    public function execute(Model $imageable, array $data): Image
    {
        return $imageable->image()->updateOrCreate([], $data);
    }
}