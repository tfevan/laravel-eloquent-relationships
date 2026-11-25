<?php

declare(strict_types=1);

namespace App\Actions\Tag;

use App\Actions\Concerns\ResolvesTaggableType;
use App\Exceptions\ResourceNotFoundException;
use Illuminate\Database\Eloquent\Model;

class ResolveTaggable
{
    use ResolvesTaggableType;

    /**
     * Find the taggable model from a morph map alias and an id.
     */
    public function execute(string $type, int $id): Model
    {
        $model = $this->taggableClass($type)::find($id);

        if ($model === null) {
            throw new ResourceNotFoundException("No {$type} found with id {$id}.");
        }

        return $model;
    }
}