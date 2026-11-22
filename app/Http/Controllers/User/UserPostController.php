<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Actions\User\AdoptPost;
use App\Actions\User\CountUserPosts;
use App\Actions\User\CreateUserPost;
use App\Actions\User\CreateUserPosts;
use App\Actions\User\DeleteUserPost;
use App\Actions\User\DeleteUserPosts;
use App\Actions\User\FilterUserPosts;
use App\Actions\User\FindLatestUserPost;
use App\Actions\User\FindUserPost;
use App\Actions\User\FirstOrCreateUserPost;
use App\Actions\User\GetUserPostStats;
use App\Actions\User\GetUserPostSummary;
use App\Actions\User\ListUsersWithPosts;
use App\Actions\User\SaveUserPost;
use App\Actions\User\SaveUserPosts;
use App\Actions\User\SearchUsersByPostTitle;
use App\Actions\User\ShowUserPosts;
use App\Actions\User\UpdateOrCreateUserPost;
use App\Actions\User\UpdateUserPost;
use App\Actions\User\UpdateUserPosts;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostBodyRequest;
use App\Http\Requests\Post\PostBulkRequest;
use App\Http\Requests\Post\PostRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * One To Many, parent side: User hasMany Post.
 */
class UserPostController extends Controller
{
    /**
     * List users with their posts, optionally filtered with ?has_posts=1&min=2 or ?has_posts=0.
     */
    public function index(Request $request, ListUsersWithPosts $action): JsonResponse
    {
        $hasPosts = $request->has('has_posts') ? $request->boolean('has_posts') : null;

        return $this->success($action->execute($hasPosts, $request->integer('min', 1)));
    }

    /**
     * List users with posts_count, posts_exists and posts_max_created_at.
     */
    public function stats(GetUserPostStats $action): JsonResponse
    {
        return $this->success($action->execute());
    }

    /**
     * Search users by a post title fragment.
     */
    public function search(Request $request, SearchUsersByPostTitle $action): JsonResponse
    {
        return $this->success($action->execute($request->string('title')->toString()));
    }

    /**
     * List all posts of a user.
     */
    public function list(User $user, ShowUserPosts $action): JsonResponse
    {
        return $this->success($action->execute($user));
    }

    /**
     * Count the posts of a user and check their existence.
     */
    public function count(User $user, CountUserPosts $action): JsonResponse
    {
        return $this->success($action->execute($user));
    }

    /**
     * Get the most recent post of a user.
     */
    public function latest(User $user, FindLatestUserPost $action): JsonResponse
    {
        return $this->success($action->execute($user));
    }

    /**
     * Filter the posts of a user by a title fragment.
     */
    public function filter(Request $request, User $user, FilterUserPosts $action): JsonResponse
    {
        return $this->success($action->execute($user, $request->string('title')->toString()));
    }

    /**
     * Find one post of a user.
     */
    public function find(User $user, int $post, FindUserPost $action): JsonResponse
    {
        return $this->success($action->execute($user, $post));
    }

    /**
     * Show the user with a post count and the three latest posts.
     */
    public function summary(User $user, GetUserPostSummary $action): JsonResponse
    {
        return $this->success($action->execute($user));
    }

    /**
     * Create a post for the user with create().
     */
    public function create(PostRequest $request, User $user, CreateUserPost $action): JsonResponse
    {
        return $this->created($action->execute($user, $request->validated()), 'Post created.');
    }

    /**
     * Create several posts for the user with createMany().
     */
    public function createMany(PostBulkRequest $request, User $user, CreateUserPosts $action): JsonResponse
    {
        return $this->created($action->execute($user, $request->validated('posts')), 'Posts created.');
    }

    /**
     * Create a post for the user with save().
     */
    public function save(PostRequest $request, User $user, SaveUserPost $action): JsonResponse
    {
        return $this->created($action->execute($user, $request->validated()), 'Post created.');
    }

    /**
     * Create several posts for the user with saveMany().
     */
    public function saveMany(PostBulkRequest $request, User $user, SaveUserPosts $action): JsonResponse
    {
        return $this->created($action->execute($user, $request->validated('posts')), 'Posts created.');
    }

    /**
     * Get the post with the given title or create it with firstOrCreate().
     */
    public function firstOrCreate(PostRequest $request, User $user, FirstOrCreateUserPost $action): JsonResponse
    {
        $post = $action->execute($user, $request->validated('title'), $request->validated('body'));

        return $post->wasRecentlyCreated
            ? $this->created($post, 'Post created.')
            : $this->success($post, 'Post already exists.');
    }

    /**
     * Update the post with the given title or create it with updateOrCreate().
     */
    public function updateOrCreate(PostRequest $request, User $user, UpdateOrCreateUserPost $action): JsonResponse
    {
        $post = $action->execute($user, $request->validated('title'), $request->validated('body'));

        return $post->wasRecentlyCreated
            ? $this->created($post, 'Post created.')
            : $this->success($post, 'Post updated.');
    }

    /**
     * Move an existing post to the user.
     */
    public function adopt(User $user, Post $post, AdoptPost $action): JsonResponse
    {
        return $this->success($action->execute($user, $post), 'Post moved.');
    }

    /**
     * Update the body of every post of the user in one query.
     */
    public function updateAll(PostBodyRequest $request, User $user, UpdateUserPosts $action): JsonResponse
    {
        return $this->success(['updated' => $action->execute($user, $request->validated())], 'Posts updated.');
    }

    /**
     * Update one post of the user.
     */
    public function update(PostRequest $request, User $user, int $post, UpdateUserPost $action): JsonResponse
    {
        return $this->success($action->execute($user, $post, $request->validated()), 'Post updated.');
    }

    /**
     * Delete one post of the user.
     */
    public function destroy(User $user, int $post, DeleteUserPost $action): JsonResponse
    {
        $action->execute($user, $post);

        return $this->success(null, 'Post deleted.');
    }

    /**
     * Delete every post of the user in one query.
     */
    public function destroyAll(User $user, DeleteUserPosts $action): JsonResponse
    {
        return $this->success(['deleted' => $action->execute($user)], 'Posts deleted.');
    }
}