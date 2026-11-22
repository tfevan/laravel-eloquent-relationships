<?php

declare(strict_types=1);

namespace App\Http\Controllers\Role;

use App\Actions\Role\AttachUserToRole;
use App\Actions\Role\DetachUserFromRole;
use App\Actions\Role\ListRolesWithUsers;
use App\Actions\Role\ShowRoleUsers;
use App\Actions\Role\SyncRoleUsers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Role\AttachUserRequest;
use App\Http\Requests\Role\SyncUsersRequest;
use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Many To Many, inverse side: Role belongsToMany User.
 */
class RoleUserController extends Controller
{
    /**
     * List roles with their users, optionally filtered with ?has_users=1 or ?has_users=0.
     */
    public function index(Request $request, ListRolesWithUsers $action): JsonResponse
    {
        $hasUsers = $request->has('has_users') ? $request->boolean('has_users') : null;

        return $this->success($action->execute($hasUsers));
    }

    /**
     * List the users of a role with their pivot columns.
     */
    public function show(Role $role, ShowRoleUsers $action): JsonResponse
    {
        return $this->success($action->execute($role));
    }

    /**
     * Add a user to the role with attach().
     */
    public function attach(AttachUserRequest $request, Role $role, AttachUserToRole $action): JsonResponse
    {
        $users = $action->execute($role, $request->integer('user_id'), $request->input('expires_at'));

        return $this->created($users, 'User attached.');
    }

    /**
     * Remove one user from the role with detach().
     */
    public function detach(Role $role, int $user, DetachUserFromRole $action): JsonResponse
    {
        return $this->success(['detached' => $action->execute($role, $user)], 'User detached.');
    }

    /**
     * Remove every user from the role with detach().
     */
    public function detachAll(Role $role, DetachUserFromRole $action): JsonResponse
    {
        return $this->success(['detached' => $action->execute($role)], 'All users detached.');
    }

    /**
     * Make the users of the role match the given list with sync().
     */
    public function sync(SyncUsersRequest $request, Role $role, SyncRoleUsers $action): JsonResponse
    {
        return $this->success($action->execute($role, $request->validated('users')), 'Users synced.');
    }
}