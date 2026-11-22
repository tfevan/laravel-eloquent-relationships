<?php

declare(strict_types=1);

namespace App\Http\Controllers\Post;

use App\Actions\Post\ListPostsByCountryCode;
use App\Actions\Post\ListPostsWithCountry;
use App\Actions\Post\ShowPostCountry;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\JsonResponse;

/**
 * Has Many Through, reverse side: Post back to Country through User.
 */
class PostCountryController extends Controller
{
    /**
     * List posts with their author and country.
     */
    public function index(ListPostsWithCountry $action): JsonResponse
    {
        return $this->success($action->execute());
    }

    /**
     * List posts written by users of a country code.
     */
    public function byCountry(string $code, ListPostsByCountryCode $action): JsonResponse
    {
        return $this->success($action->execute($code));
    }

    /**
     * Show the country of a post.
     */
    public function show(Post $post, ShowPostCountry $action): JsonResponse
    {
        return $this->success($action->execute($post));
    }
}