<?php

declare(strict_types=1);

namespace App\Actions\Tag;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;

class CreateTaggableTag
{
    /**
     * Create a new tag and attach it in one call with create() on the relation.
     */
    public function execute(Model $taggable, array $data): Tag
    {
        return $taggable->tags()->create($data);
    }
}