<?php

declare(strict_types=1);

namespace App\Http\Controllers\Comment;

use App\Actions\Comment\DeleteComment;
use App\Actions\Comment\ListComments;
use App\Actions\Comment\ListCommentsWithCommentableDetails;
use App\Actions\Comment\ReassignComment;
use App\Actions\Comment\ResolveCommentable;
use App\Actions\Comment\SearchCommentsByCommentableTitle;
use App\Actions\Comment\ShowCommentable;
use App\Actions\Comment\UpdateComment;
use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\CommentRequest;
use App\Http\Requests\Comment\ReassignCommentRequest;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Polymorphic One To Many, child side: Comment morphTo commentable.
 */
class CommentController extends Controller
{
    /**
     * List comments with their parent, optionally filtered with ?type=post and ?approved=0.
     */
    public function index(Request $request, ListComments $action): JsonResponse
    {
        $approved = $request->has('approved') ? $request->boolean('approved') : null;

        return $this->success($action->execute($request->input('type'), $approved));
    }

    /**
     * List comments with a different nested relation for each parent type.
     */
    public function details(ListCommentsWithCommentableDetails $action): JsonResponse
    {
        return $this->success($action->execute());
    }

    /**
     * Search comments by the title of the post or the video.
     */
    public function search(Request $request, SearchCommentsByCommentableTitle $action): JsonResponse
    {
        return $this->success($action->execute($request->string('term')->toString()));
    }

    /**
     * Show the parent of the comment.
     */
    public function show(Comment $comment, ShowCommentable $action): JsonResponse
    {
        return $this->success($action->execute($comment));
    }

    /**
     * Move the comment to another post or video.
     */
    public function reassign(ReassignCommentRequest $request, Comment $comment, ResolveCommentable $resolve, ReassignComment $action): JsonResponse
    {
        $commentable = $resolve->execute($request->string('type')->toString(), $request->integer('id'));

        return $this->success($action->execute($comment, $commentable), 'Comment reassigned.');
    }

    /**
     * Update the comment.
     */
    public function update(CommentRequest $request, Comment $comment, UpdateComment $action): JsonResponse
    {
        return $this->success($action->execute($comment, $request->validated()), 'Comment updated.');
    }

    /**
     * Delete the comment.
     */
    public function destroy(Comment $comment, DeleteComment $action): JsonResponse
    {
        return $this->success(['deleted' => $action->execute($comment)], 'Comment deleted.');
    }
}