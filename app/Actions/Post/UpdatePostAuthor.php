<?php

declare(strict_types=1);

namespace App\Actions\Post;

use App\Exceptions\ResourceNotFoundException;
use App\Models\Post;
use App\Models\User;

class UpdatePostAuthor
{
    /**
     * Update the author of the post through the child relation.
     */
    public function execute(Post $post, array $data): User
    {
        if (! $post->user()->exists()) {
            throw new ResourceNotFoundException('The post has no author.');
        }

        $post->user()->update($data);

        return $post->user()->firstOrFail();
    }
}