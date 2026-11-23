<?php

declare(strict_types=1);

namespace App\Actions\Concerns;

use App\Exceptions\ResourceNotFoundException;
use Illuminate\Database\Eloquent\Relations\Relation;

trait ResolvesCommentableType
{
    /**
     * Resolve a morph map alias such as "post" to a model class that can own comments.
     */
    protected function commentableClass(string $type): string
    {
        $class = in_array($type, ['post', 'video'], true) ? Relation::getMorphedModel($type) : null;

        if ($class === null) {
            throw new ResourceNotFoundException("Unknown commentable type [{$type}].");
        }

        return $class;
    }
}