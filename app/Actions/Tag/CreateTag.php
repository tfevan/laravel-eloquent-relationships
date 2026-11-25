<?php

declare(strict_types=1);

namespace App\Actions\Tag;

use App\Models\Tag;

class CreateTag
{
    /**
     * Create a tag that is not attached to anything yet.
     */
    public function execute(array $data): Tag
    {
        return Tag::create($data);
    }
}