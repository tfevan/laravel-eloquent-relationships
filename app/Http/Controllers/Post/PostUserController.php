<?php

declare(strict_types=1);

namespace App\Http\Controllers\Post;

use App\Actions\Post\CheckPostAuthor;
use App\Actions\Post\DeletePost;
use App\Actions\Post\DeletePostAuthor;
use App\Actions\Post\ListOrphanPosts;
use App\Actions\Post\ListPostsByUser;
use App\Actions\Post\ListPostsWithAuthor;
use App\Actions\Post\ReassignPostAuthor;
use App\Actions\Post\RemovePostAuthor;
use App\Actions\Post\SearchPostsByAuthorName;
use App\Actions\Post\ShowPostAuthor;
use App\Actions\Post\UpdatePostAuthor;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\ReassignPostRequest;
use App\Http\Requests\User\UserNameRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * One To Many, inverse side: Post belongsTo User.
 */
class PostUserController extends Controller
{
    /**
     * List posts with their author, use ?default=1 for the Guest Author default model.
     */
    public function index(Request $request, ListPostsWithAuthor $action): JsonResponse
    {
        return $this->success($action->execute($request->boolean('default')));
    }

    /**
     * List posts that have no author.
     */
    public function orphans(ListOrphanPosts $action): JsonResponse
    {
        return $this->success($action->execute());
    }

    /**
     * Search posts by the name of their author.
     */
    public function search(Request $request, SearchPostsByAuthorName $action): JsonResponse
    {
        return $this->success($action->execute($request->string('name')->toString()));
    }

    /**
     * List the posts of a user from the post side.
     */
    public function byUser(User $user, ListPostsByUser $action): JsonResponse
    {
        return $this->success($action->execute($user));
    }

    /**
     * Show the author of a post, use ?default=1 for the Guest Author default model.
     */
    public function show(Request $request, Post $post, ShowPostAuthor $action): JsonResponse
    {
        return $this->success($action->execute($post, $request->boolean('default')));
    }

    /**
     * Check if the user wrote the post.
     */
    public function isAuthor(Post $post, User $user, CheckPostAuthor $action): JsonResponse
    {
        return $this->success(['is_author' => $action->execute($post, $user)]);
    }

    /**
     * Move the post to another user.
     */
    public function associate(ReassignPostRequest $request, Post $post, ReassignPostAuthor $action): JsonResponse
    {
        return $this->success($action->execute($post, $request->integer('user_id')), 'Post moved.');
    }

    /**
     * Detach the post from its author.
     */
    public function dissociate(Post $post, RemovePostAuthor $action): JsonResponse
    {
        return $this->success($action->execute($post), 'Author removed.');
    }

    /**
     * Update the author of the post through the post.
     */
    public function updateUser(UserNameRequest $request, Post $post, UpdatePostAuthor $action): JsonResponse
    {
        return $this->success($action->execute($post, $request->validated()), 'Author updated.');
    }

    /**
     * Delete the post and keep its author.
     */
    public function destroy(Post $post, DeletePost $action): JsonResponse
    {
        return $this->success(['deleted' => $action->execute($post)], 'Post deleted.');
    }

    /**
     * Delete the author of the post, the posts of that author stay with user_id set to null.
     */
    public function destroyUser(Post $post, DeletePostAuthor $action): JsonResponse
    {
        return $this->success(['deleted' => $action->execute($post)], 'Author deleted.');
    }
}