<?php

declare(strict_types=1);

namespace App\Http\Controllers\Image;

use App\Actions\Image\CheckImageableHasImage;
use App\Actions\Image\CreateImageableImage;
use App\Actions\Image\DeleteImageableImage;
use App\Actions\Image\ListImageables;
use App\Actions\Image\ResolveImageable;
use App\Actions\Image\ShowImageableImage;
use App\Actions\Image\UpdateImageableImage;
use App\Actions\Image\UpdateOrCreateImageableImage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Image\ImageRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ImageableController extends Controller
{
    /**
     * List users or posts with their image, optionally filtered with ?has_image=0.
     */
    public function index(Request $request, string $type, ListImageables $action): JsonResponse
    {
        $hasImage = $request->has('has_image') ? $request->boolean('has_image') : null;

        return $this->success($action->execute($type, $hasImage));
    }

    /**
     * Show the image of a user or a post.
     */
    public function show(string $type, int $id, ResolveImageable $resolve, ShowImageableImage $action): JsonResponse
    {
        return $this->success($action->execute($resolve->execute($type, $id)));
    }

    /**
     * Check if a user or a post has an image.
     */
    public function exists(string $type, int $id, ResolveImageable $resolve, CheckImageableHasImage $action): JsonResponse
    {
        return $this->success(['has_image' => $action->execute($resolve->execute($type, $id))]);
    }

    /**
     * Create the image of a user or a post.
     */
    public function create(ImageRequest $request, string $type, int $id, ResolveImageable $resolve, CreateImageableImage $action): JsonResponse
    {
        return $this->created($action->execute($resolve->execute($type, $id), $request->validated()), 'Image created.');
    }

    /**
     * Update the image or create it when missing.
     */
    public function updateOrCreate(
        ImageRequest $request, 
        string $type, 
        int $id, 
        ResolveImageable $resolve, 
        UpdateOrCreateImageableImage $action
    ): JsonResponse
    {
        return $this->success($action->execute($resolve->execute($type, $id), $request->validated()), 'Image saved.');
    }

    /**
     * Update the existing image.
     */
    public function update(
        ImageRequest $request, 
        string $type, 
        int $id, 
        ResolveImageable $resolve, 
        UpdateImageableImage $action
    ): JsonResponse
    {
        return $this->success($action->execute($resolve->execute($type, $id), $request->validated()), 'Image updated.');
    }

    /**
     * Delete the image of a user or a post.
     */
    public function destroy(
        string $type, 
        int $id, 
        ResolveImageable $resolve, 
        DeleteImageableImage $action
    ): JsonResponse
    {
        return $this->success(['deleted' => $action->execute($resolve->execute($type, $id))], 'Image deleted.');
    }
}