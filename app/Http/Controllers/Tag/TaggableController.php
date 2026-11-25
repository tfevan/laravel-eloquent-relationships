<?php

declare(strict_types=1);

namespace App\Http\Controllers\Tag;

use App\Actions\Tag\AttachTagToTaggable;
use App\Actions\Tag\CheckTaggableHasTag;
use App\Actions\Tag\CreateTaggableTag;
use App\Actions\Tag\DetachTaggableTags;
use App\Actions\Tag\ListTaggables;
use App\Actions\Tag\ResolveTaggable;
use App\Actions\Tag\ShowTaggableTags;
use App\Actions\Tag\SyncTaggableTags;
use App\Actions\Tag\SyncTaggableTagsWithoutDetaching;
use App\Actions\Tag\ToggleTaggableTags;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\AttachTagRequest;
use App\Http\Requests\Tag\TagIdsRequest;
use App\Http\Requests\Tag\TagRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Polymorphic Many To Many, parent side: Post and Video morphToMany Tag.
 */
class TaggableController extends Controller
{
    /**
     * List posts or videos with their tags, optionally filtered with ?has_tags=0 or ?tag=php.
     */
    public function index(Request $request, string $type, ListTaggables $action): JsonResponse
    {
        $hasTags = $request->has('has_tags') ? $request->boolean('has_tags') : null;

        return $this->success($action->execute($type, $hasTags, $request->input('tag')));
    }

    /**
     * Show the tags of a post or a video.
     */
    public function show(string $type, int $id, ResolveTaggable $resolve, ShowTaggableTags $action): JsonResponse
    {
        return $this->success($action->execute($resolve->execute($type, $id)));
    }

    /**
     * Check if a post or a video has a tag with ?name=php.
     */
    public function has(Request $request, string $type, int $id, ResolveTaggable $resolve, CheckTaggableHasTag $action): JsonResponse
    {
        return $this->success(['has_tag' => $action->execute($resolve->execute($type, $id), $request->string('name')->toString())]);
    }

    /**
     * Attach an existing tag with attach().
     */
    public function attach(AttachTagRequest $request, string $type, int $id, ResolveTaggable $resolve, AttachTagToTaggable $action): JsonResponse
    {
        return $this->created($action->execute($resolve->execute($type, $id), $request->integer('tag_id')), 'Tag attached.');
    }

    /**
     * Create a new tag and attach it in one call.
     */
    public function create(TagRequest $request, string $type, int $id, ResolveTaggable $resolve, CreateTaggableTag $action): JsonResponse
    {
        return $this->created($action->execute($resolve->execute($type, $id), $request->validated()), 'Tag created and attached.');
    }

    /**
     * Replace the tags with sync().
     */
    public function sync(TagIdsRequest $request, string $type, int $id, ResolveTaggable $resolve, SyncTaggableTags $action): JsonResponse
    {
        return $this->success($action->execute($resolve->execute($type, $id), $request->validated('tags')), 'Tags synced.');
    }

    /**
     * Add tags and keep the existing ones with syncWithoutDetaching().
     */
    public function syncWithoutDetaching(TagIdsRequest $request, string $type, int $id, ResolveTaggable $resolve, SyncTaggableTagsWithoutDetaching $action): JsonResponse
    {
        return $this->success($action->execute($resolve->execute($type, $id), $request->validated('tags')), 'Tags synced without detaching.');
    }

    /**
     * Toggle tags with toggle().
     */
    public function toggle(TagIdsRequest $request, string $type, int $id, ResolveTaggable $resolve, ToggleTaggableTags $action): JsonResponse
    {
        return $this->success($action->execute($resolve->execute($type, $id), $request->validated('tags')), 'Tags toggled.');
    }

    /**
     * Detach one tag with detach($id).
     */
    public function detach(string $type, int $id, int $tag, ResolveTaggable $resolve, DetachTaggableTags $action): JsonResponse
    {
        return $this->success(['detached' => $action->execute($resolve->execute($type, $id), $tag)], 'Tag detached.');
    }

    /**
     * Detach every tag, detach() without an id removes all.
     */
    public function detachAll(string $type, int $id, ResolveTaggable $resolve, DetachTaggableTags $action): JsonResponse
    {
        return $this->success(['detached' => $action->execute($resolve->execute($type, $id))], 'All tags detached.');
    }
}