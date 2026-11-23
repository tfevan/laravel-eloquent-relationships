<?php

declare(strict_types=1);

namespace App\Actions\Image;

use App\Models\Image;
use Illuminate\Database\Eloquent\Model;

class ShowImageable
{
    /**
     * Get the parent of the image, it can be a user or a post.
     */
    public function execute(Image $image): ?Model
    {
        return $image->imageable;
    }
}