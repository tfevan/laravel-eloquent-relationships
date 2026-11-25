<?php

declare(strict_types=1);

namespace App\Actions\Tag;

use App\Models\Tag;

class UpdateTag
{
    /**
     * Update a tag, every post and video that uses it sees the new name.
     */
    public function execute(Tag $tag, array $data): Tag
    {
        $tag->update($data);

        return $tag;
    }
}