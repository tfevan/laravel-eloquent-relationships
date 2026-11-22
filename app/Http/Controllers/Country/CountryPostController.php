<?php

declare(strict_types=1);

namespace App\Http\Controllers\Country;

use App\Actions\Country\CountCountryPosts;
use App\Actions\Country\DeleteCountryPosts;
use App\Actions\Country\FilterCountryPosts;
use App\Actions\Country\FindCountryPost;
use App\Actions\Country\FindLatestCountryPost;
use App\Actions\Country\GetCountryPostStats;
use App\Actions\Country\ListCountriesWithPosts;
use App\Actions\Country\ListCountryUsersWithPostCount;
use App\Actions\Country\PaginateCountryPosts;
use App\Actions\Country\SearchCountriesByPostTitle;
use App\Actions\Country\ShowCountryPosts;
use App\Actions\Country\UpdateCountryPosts;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostBodyRequest;
use App\Models\Country;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Has Many Through, parent side: Country hasManyThrough Post through User.
 */
class CountryPostController extends Controller
{
    /**
     * List countries with a post count, optionally filtered with ?has_posts=1 and ?min=2.
     */
    public function index(Request $request, ListCountriesWithPosts $action): JsonResponse
    {
        $hasPosts = $request->has('has_posts') ? $request->boolean('has_posts') : null;

        return $this->success($action->execute($hasPosts, $request->integer('min', 1)));
    }

    /**
     * Show the user count and the post count of every country.
     */
    public function stats(GetCountryPostStats $action): JsonResponse
    {
        return $this->success($action->execute());
    }

    /**
     * Search countries by the title of a post.
     */
    public function search(Request $request, SearchCountriesByPostTitle $action): JsonResponse
    {
        return $this->success($action->execute($request->string('title')->toString()));
    }

    /**
     * Show all posts of the country.
     */
    public function show(Country $country, ShowCountryPosts $action): JsonResponse
    {
        return $this->success($action->execute($country));
    }

    /**
     * Count the posts of the country.
     */
    public function count(Country $country, CountCountryPosts $action): JsonResponse
    {
        return $this->success(['count' => $action->execute($country)]);
    }

    /**
     * Show the newest post of the country.
     */
    public function latest(Country $country, FindLatestCountryPost $action): JsonResponse
    {
        return $this->success($action->execute($country));
    }

    /**
     * Filter the posts of the country by title.
     */
    public function filter(Request $request, Country $country, FilterCountryPosts $action): JsonResponse
    {
        return $this->success($action->execute($country, $request->string('title')->toString()));
    }

    /**
     * Paginate the posts of the country.
     */
    public function paginate(Request $request, Country $country, PaginateCountryPosts $action): JsonResponse
    {
        return $this->success($action->execute($country, $request->integer('per_page', 10)));
    }

    /**
     * Show one post inside the country scope.
     */
    public function post(Country $country, int $post, FindCountryPost $action): JsonResponse
    {
        return $this->success($action->execute($country, $post));
    }

    /**
     * List the users of the country with their post count.
     */
    public function users(Country $country, ListCountryUsersWithPostCount $action): JsonResponse
    {
        return $this->success($action->execute($country));
    }

    /**
     * Bulk update the body of every post of the country.
     */
    public function update(PostBodyRequest $request, Country $country, UpdateCountryPosts $action): JsonResponse
    {
        return $this->success(['updated' => $action->execute($country, $request->validated())], 'Posts updated.');
    }

    /**
     * Bulk delete every post of the country.
     */
    public function destroy(Country $country, DeleteCountryPosts $action): JsonResponse
    {
        return $this->success(['deleted' => $action->execute($country)], 'Posts deleted.');
    }
}