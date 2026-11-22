<?php

declare(strict_types=1);

namespace App\Http\Controllers\Phone;

use App\Actions\Phone\CheckPhoneOwner;
use App\Actions\Phone\DeletePhone;
use App\Actions\Phone\DeletePhoneOwner;
use App\Actions\Phone\FindPhoneByUser;
use App\Actions\Phone\ListPhonesWithUser;
use App\Actions\Phone\ReassignPhoneOwner;
use App\Actions\Phone\ShowPhoneOwner;
use App\Actions\Phone\UpdatePhoneOwner;
use App\Http\Controllers\Controller;
use App\Http\Requests\Phone\ReassignPhoneRequest;
use App\Http\Requests\User\UserNameRequest;
use App\Models\Phone;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * One To One, inverse side: Phone belongsTo User.
 */
class PhoneUserController extends Controller
{
    /**
     * List phones with their owner, optionally filtered with ?name=.
     */
    public function index(Request $request, ListPhonesWithUser $action): JsonResponse
    {
        $name = $request->has('name') ? $request->string('name')->toString() : null;

        return $this->success($action->execute($name));
    }

    /**
     * Find the phone of a user from the phone side.
     */
    public function byUser(User $user, FindPhoneByUser $action): JsonResponse
    {
        return $this->success($action->execute($user));
    }

    /**
     * Show the owner of a phone.
     */
    public function show(Phone $phone, ShowPhoneOwner $action): JsonResponse
    {
        return $this->success($action->execute($phone));
    }

    /**
     * Check if the user owns the phone.
     */
    public function isOwner(Phone $phone, User $user, CheckPhoneOwner $action): JsonResponse
    {
        return $this->success(['is_owner' => $action->execute($phone, $user)]);
    }

    /**
     * Move the phone to another user.
     */
    public function associate(ReassignPhoneRequest $request, Phone $phone, ReassignPhoneOwner $action): JsonResponse
    {
        return $this->success($action->execute($phone, $request->integer('user_id')), 'Phone moved.');
    }

    /**
     * Update the owner of the phone through the phone.
     */
    public function updateUser(UserNameRequest $request, Phone $phone, UpdatePhoneOwner $action): JsonResponse
    {
        return $this->success($action->execute($phone, $request->validated()), 'Owner updated.');
    }

    /**
     * Delete the phone and keep its owner.
     */
    public function destroy(Phone $phone, DeletePhone $action): JsonResponse
    {
        return $this->success(['deleted' => $action->execute($phone)], 'Phone deleted.');
    }

    /**
     * Delete the owner of the phone, the cascade removes the phone too.
     */
    public function destroyUser(Phone $phone, DeletePhoneOwner $action): JsonResponse
    {
        return $this->success(['deleted' => $action->execute($phone)], 'Owner deleted.');
    }
}