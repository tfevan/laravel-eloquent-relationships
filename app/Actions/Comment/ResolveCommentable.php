<?php

declare(strict_types=1);

namespace App\Actions\Comment;

use App\Actions\Concerns\ResolvesCommentableType;
use App\Exceptions\ResourceNotFoundException;
use Illuminate\Database\Eloquent\Model;

class ResolveCommentable
{
    use ResolvesCommentableType;

    /**
     * Find the parent model from a morph map alias and an id.
     */
    public function execute(string $type, int $id): Model
    {
        $model = $this->commentableClass($type)::find($id);

        if ($model === null) {
            throw new ResourceNotFoundException("No {$type} found with id {$id}.");
        }

        return $model;
    }
}