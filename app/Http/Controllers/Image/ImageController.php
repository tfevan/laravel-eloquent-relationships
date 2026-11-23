<?php

declare(strict_types=1);

namespace App\Http\Controllers\Image;

use App\Actions\Image\DeleteImage;
use App\Actions\Image\ListImagesWithImageable;
use App\Actions\Image\ListImagesWithImageableDetails;
use App\Actions\Image\ReassignImage;
use App\Actions\Image\ResolveImageable;
use App\Actions\Image\SearchImagesByImageableName;
use App\Actions\Image\ShowImageable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Image\ReassignImageRequest;
use App\Models\Image;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Polymorphic One To One, child side: Image morphTo imageable.
 */
class ImageController extends Controller
{
    /**
     * List images with their parent, optionally filtered with ?type=user or ?type=post.
     */
    public function index(Request $request, ListImagesWithImageable $action): JsonResponse
    {
        return $this->success($action->execute($request->input('type')));
    }

    /**
     * List images with a different nested relation for each parent type.
     */
    public function details(ListImagesWithImageableDetails $action): JsonResponse
    {
        return $this->success($action->execute());
    }

    /**
     * Search images by the user name or the post title.
     */
    public function search(Request $request, SearchImagesByImageableName $action): JsonResponse
    {
        return $this->success($action->execute($request->string('term')->toString()));
    }

    /**
     * Show the parent of the image.
     */
    public function show(Image $image, ShowImageable $action): JsonResponse
    {
        return $this->success($action->execute($image));
    }

    /**
     * Move the image to another user or post.
     */
    public function reassign(ReassignImageRequest $request, Image $image, ResolveImageable $resolve, ReassignImage $action): JsonResponse
    {
        $imageable = $resolve->execute($request->string('type')->toString(), $request->integer('id'));

        return $this->success($action->execute($image, $imageable), 'Image reassigned.');
    }

    /**
     * Delete the image.
     */
    public function destroy(Image $image, DeleteImage $action): JsonResponse
    {
        return $this->success(['deleted' => $action->execute($image)], 'Image deleted.');
    }
}