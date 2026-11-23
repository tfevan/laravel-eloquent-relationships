<?php

declare(strict_types=1);

namespace App\Actions\Concerns;

use App\Exceptions\ResourceNotFoundException;
use Illuminate\Database\Eloquent\Relations\Relation;

trait ResolvesImageableType
{
    /**
     * Resolve a morph map alias such as "user" to a model class that can own an image.
     */
    protected function imageableClass(string $type): string
    {
        $class = in_array($type, ['user', 'post'], true) ? Relation::getMorphedModel($type) : null;

        if ($class === null) {
            throw new ResourceNotFoundException("Unknown imageable type [{$type}].");
        }

        return $class;
    }
}