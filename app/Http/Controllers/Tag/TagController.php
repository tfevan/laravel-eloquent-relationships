<?php

declare(strict_types=1);

namespace App\Http\Controllers\Tag;

use App\Actions\Tag\AttachTaggableToTag;
use App\Actions\Tag\CreateTag;
use App\Actions\Tag\DeleteTag;
use App\Actions\Tag\DetachTaggableFromTag;
use App\Actions\Tag\ListTags;
use App\Actions\Tag\ListTagsByTaggableType;
use App\Actions\Tag\ShowTagTaggables;
use App\Actions\Tag\SyncTagTaggables;
use App\Actions\Tag\UpdateTag;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\AttachTaggableRequest;
use App\Http\Requests\Tag\TaggableIdsRequest;
use App\Http\Requests\Tag\TagRequest;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Polymorphic Many To Many, tag side: Tag morphedByMany Post and Video.
 */
class TagController extends Controller
{
    /**
     * List tags with post and video counts, optionally filtered with ?used=0.
     */
    public function index(Request $request, ListTags $action): JsonResponse
    {
        $used = $request->has('used') ? $request->boolean('used') : null;

        return $this->success($action->execute($used));
    }

    /**
     * List the tags used by posts or by videos.
     */
    public function byType(string $type, ListTagsByTaggableType $action): JsonResponse
    {
        return $this->success($action->execute($type));
    }

    /**
     * Create a tag.
     */
    public function store(TagRequest $request, CreateTag $action): JsonResponse
    {
        return $this->created($action->execute($request->validated()), 'Tag created.');
    }

    /**
     * Update a tag.
     */
    public function update(TagRequest $request, Tag $tag, UpdateTag $action): JsonResponse
    {
        return $this->success($action->execute($tag, $request->validated()), 'Tag updated.');
    }

    /**
     * Delete a tag.
     */
    public function destroy(Tag $tag, DeleteTag $action): JsonResponse
    {
        return $this->success(['deleted' => $action->execute($tag)], 'Tag deleted.');
    }

    /**
     * Show the posts or the videos of a tag.
     */
    public function show(Tag $tag, string $type, ShowTagTaggables $action): JsonResponse
    {
        return $this->success($action->execute($tag, $type));
    }

    /**
     * Attach a post or a video to the tag.
     */
    public function attach(AttachTaggableRequest $request, Tag $tag, string $type, AttachTaggableToTag $action): JsonResponse
    {
        return $this->created($action->execute($tag, $type, $request->integer('id')), 'Attached to the tag.');
    }

    /**
     * Make the tag belong to exactly the given posts or videos.
     */
    public function sync(TaggableIdsRequest $request, Tag $tag, string $type, SyncTagTaggables $action): JsonResponse
    {
        return $this->success($action->execute($tag, $type, $request->validated('ids')), 'Synced.');
    }

    /**
     * Detach one post or video from the tag.
     */
    public function detach(Tag $tag, string $type, int $id, DetachTaggableFromTag $action): JsonResponse
    {
        return $this->success(['detached' => $action->execute($tag, $type, $id)], 'Detached from the tag.');
    }

    /**
     * Detach every post or video of that type from the tag.
     */
    public function detachAll(Tag $tag, string $type, DetachTaggableFromTag $action): JsonResponse
    {
        return $this->success(['detached' => $action->execute($tag, $type)], 'All detached from the tag.');
    }
}