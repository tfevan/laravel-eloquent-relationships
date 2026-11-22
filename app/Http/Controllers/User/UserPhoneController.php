<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Actions\User\CheckUserHasPhone;
use App\Actions\User\CreateUserPhone;
use App\Actions\User\DeleteUserPhone;
use App\Actions\User\FirstOrCreateUserPhone;
use App\Actions\User\ListUsersWithPhone;
use App\Actions\User\SaveUserPhone;
use App\Actions\User\SearchUsersByPhoneNumber;
use App\Actions\User\ShowUserPhone;
use App\Actions\User\UpdateOrCreateUserPhone;
use App\Actions\User\UpdateUserPhone;
use App\Http\Controllers\Controller;
use App\Http\Requests\Phone\PhoneRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * One To One, parent side: User hasOne Phone.
 */
class UserPhoneController extends Controller
{
    /**
     * List users with their phone, optionally filtered with ?has_phone=1 or ?has_phone=0.
     */
    public function index(Request $request, ListUsersWithPhone $action): JsonResponse
    {
        $hasPhone = $request->has('has_phone') ? $request->boolean('has_phone') : null;

        return $this->success($action->execute($hasPhone));
    }

    /**
     * Search users by a phone number fragment.
     */
    public function search(Request $request, SearchUsersByPhoneNumber $action): JsonResponse
    {
        return $this->success($action->execute($request->string('number')->toString()));
    }

    /**
     * Show the phone of a user.
     */
    public function show(User $user, ShowUserPhone $action): JsonResponse
    {
        return $this->success($action->execute($user));
    }

    /**
     * Check if the user has a phone.
     */
    public function exists(User $user, CheckUserHasPhone $action): JsonResponse
    {
        return $this->success(['has_phone' => $action->execute($user)]);
    }

    /**
     * Create the phone of a user with create().
     */
    public function create(PhoneRequest $request, User $user, CreateUserPhone $action): JsonResponse
    {
        return $this->created($action->execute($user, $request->validated()), 'Phone created.');
    }

    /**
     * Create the phone of a user with save().
     */
    public function save(PhoneRequest $request, User $user, SaveUserPhone $action): JsonResponse
    {
        return $this->created($action->execute($user, $request->validated()), 'Phone created.');
    }

    /**
     * Get the existing phone or create it with firstOrCreate().
     */
    public function firstOrCreate(PhoneRequest $request, User $user, FirstOrCreateUserPhone $action): JsonResponse
    {
        $phone = $action->execute($user, $request->validated());

        return $phone->wasRecentlyCreated
            ? $this->created($phone, 'Phone created.')
            : $this->success($phone, 'Phone already exists.');
    }

    /**
     * Update the phone or create it with updateOrCreate().
     */
    public function updateOrCreate(PhoneRequest $request, User $user, UpdateOrCreateUserPhone $action): JsonResponse
    {
        $phone = $action->execute($user, $request->validated());

        return $phone->wasRecentlyCreated
            ? $this->created($phone, 'Phone created.')
            : $this->success($phone, 'Phone updated.');
    }

    /**
     * Update the existing phone through the relation query.
     */
    public function update(PhoneRequest $request, User $user, UpdateUserPhone $action): JsonResponse
    {
        return $this->success($action->execute($user, $request->validated()), 'Phone updated.');
    }

    /**
     * Delete the phone of a user.
     */
    public function destroy(User $user, DeleteUserPhone $action): JsonResponse
    {
        return $this->success(['deleted' => $action->execute($user)], 'Phone deleted.');
    }
}