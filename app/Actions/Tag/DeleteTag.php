<?php

declare(strict_types=1);

namespace App\Actions\Tag;

use App\Models\Tag;

class DeleteTag
{
    /**
     * Delete a tag, its taggables rows are removed by the foreign key cascade.
     */
    public function execute(Tag $tag): bool
    {
        return (bool) $tag->delete();
    }
}