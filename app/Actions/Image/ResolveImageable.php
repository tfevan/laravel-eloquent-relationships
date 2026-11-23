<?php

declare(strict_types=1);

namespace App\Actions\Image;

use App\Actions\Concerns\ResolvesImageableType;
use App\Exceptions\ResourceNotFoundException;
use Illuminate\Database\Eloquent\Model;

class ResolveImageable
{
    use ResolvesImageableType;

    /**
     * Find the parent model from a morph map alias and an id.
     */
    public function execute(string $type, int $id): Model
    {
        $model = $this->imageableClass($type)::find($id);

        if ($model === null) {
            throw new ResourceNotFoundException("No {$type} found with id {$id}.");
        }

        return $model;
    }
}