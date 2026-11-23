<?php

declare(strict_types=1);

namespace App\Http\Controllers\Comment;

use App\Actions\Comment\ApproveCommentableComments;
use App\Actions\Comment\CountCommentableComments;
use App\Actions\Comment\CreateCommentableComment;
use App\Actions\Comment\CreateCommentableComments;
use App\Actions\Comment\DeleteCommentableComment;
use App\Actions\Comment\DeleteCommentableComments;
use App\Actions\Comment\FilterCommentableComments;
use App\Actions\Comment\FindCommentableComment;
use App\Actions\Comment\FindLatestCommentableComment;
use App\Actions\Comment\ListCommentables;
use App\Actions\Comment\ResolveCommentable;
use App\Actions\Comment\SaveCommentableComment;
use App\Actions\Comment\ShowCommentableComments;
use App\Actions\Comment\UpdateCommentableComment;
use App\Actions\Comment\UpdateCommentableComments;
use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\CommentApprovalRequest;
use App\Http\Requests\Comment\CommentBulkRequest;
use App\Http\Requests\Comment\CommentRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Polymorphic One To Many, parent side: Post and Video morphMany Comment.
 */
class CommentableController extends Controller
{
    /**
     * List posts or videos with comment counts, optionally filtered with ?has_comments=1 and ?min=2.
     */
    public function index(Request $request, string $type, ListCommentables $action): JsonResponse
    {
        $hasComments = $request->has('has_comments') ? $request->boolean('has_comments') : null;

        return $this->success($action->execute($type, $hasComments, $request->integer('min', 1)));
    }

    /**
     * Show all comments of a post or a video.
     */
    public function list(string $type, int $id, ResolveCommentable $resolve, ShowCommentableComments $action): JsonResponse
    {
        return $this->success($action->execute($resolve->execute($type, $id)));
    }

    /**
     * Count the comments of a post or a video.
     */
    public function count(string $type, int $id, ResolveCommentable $resolve, CountCommentableComments $action): JsonResponse
    {
        return $this->success(['count' => $action->execute($resolve->execute($type, $id))]);
    }

    /**
     * Show the newest comment of a post or a video.
     */
    public function latest(string $type, int $id, ResolveCommentable $resolve, FindLatestCommentableComment $action): JsonResponse
    {
        return $this->success($action->execute($resolve->execute($type, $id)));
    }

    /**
     * Filter the comments with ?approved=0 and ?term=word.
     */
    public function filter(Request $request, string $type, int $id, ResolveCommentable $resolve, FilterCommentableComments $action): JsonResponse
    {
        $approved = $request->has('approved') ? $request->boolean('approved') : null;

        return $this->success($action->execute($resolve->execute($type, $id), $approved, $request->input('term')));
    }

    /**
     * Show one comment inside the parent scope.
     */
    public function find(string $type, int $id, int $comment, ResolveCommentable $resolve, FindCommentableComment $action): JsonResponse
    {
        return $this->success($action->execute($resolve->execute($type, $id), $comment));
    }

    /**
     * Create a comment with create().
     */
    public function create(CommentRequest $request, string $type, int $id, ResolveCommentable $resolve, CreateCommentableComment $action): JsonResponse
    {
        return $this->created($action->execute($resolve->execute($type, $id), $request->validated()), 'Comment created.');
    }

    /**
     * Create many comments with createMany().
     */
    public function createMany(CommentBulkRequest $request, string $type, int $id, ResolveCommentable $resolve, CreateCommentableComments $action): JsonResponse
    {
        return $this->created($action->execute($resolve->execute($type, $id), $request->validated('comments')), 'Comments created.');
    }

    /**
     * Save a comment with save().
     */
    public function save(CommentRequest $request, string $type, int $id, ResolveCommentable $resolve, SaveCommentableComment $action): JsonResponse
    {
        return $this->created($action->execute($resolve->execute($type, $id), $request->validated()), 'Comment saved.');
    }

    /**
     * Update one comment inside the parent scope.
     */
    public function update(CommentRequest $request, string $type, int $id, int $comment, ResolveCommentable $resolve, UpdateCommentableComment $action): JsonResponse
    {
        return $this->success($action->execute($resolve->execute($type, $id), $comment, $request->validated()), 'Comment updated.');
    }

    /**
     * Set the approval state of every comment of the parent.
     */
    public function updateAll(CommentApprovalRequest $request, string $type, int $id, ResolveCommentable $resolve, UpdateCommentableComments $action): JsonResponse
    {
        return $this->success(['updated' => $action->execute($resolve->execute($type, $id), $request->validated())], 'Comments updated.');
    }

    /**
     * Approve the pending comments of the parent.
     */
    public function approve(string $type, int $id, ResolveCommentable $resolve, ApproveCommentableComments $action): JsonResponse
    {
        return $this->success(['approved' => $action->execute($resolve->execute($type, $id))], 'Pending comments approved.');
    }

    /**
     * Delete one comment inside the parent scope.
     */
    public function destroy(string $type, int $id, int $comment, ResolveCommentable $resolve, DeleteCommentableComment $action): JsonResponse
    {
        return $this->success(['deleted' => $action->execute($resolve->execute($type, $id), $comment)], 'Comment deleted.');
    }

    /**
     * Delete every comment of the parent.
     */
    public function destroyAll(string $type, int $id, ResolveCommentable $resolve, DeleteCommentableComments $action): JsonResponse
    {
        return $this->success(['deleted' => $action->execute($resolve->execute($type, $id))], 'Comments deleted.');
    }
}