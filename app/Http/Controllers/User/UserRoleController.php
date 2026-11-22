<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Actions\User\AttachRoleToUser;
use App\Actions\User\CheckUserHasRole;
use App\Actions\User\DetachRoleFromUser;
use App\Actions\User\ListUserRolesByPivot;
use App\Actions\User\ListUsersWithRoles;
use App\Actions\User\ShowUserRoles;
use App\Actions\User\SyncUserRoles;
use App\Actions\User\SyncUserRolesWithoutDetaching;
use App\Actions\User\ToggleUserRoles;
use App\Actions\User\UpdateUserRolePivot;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\AttachRoleRequest;
use App\Http\Requests\User\PivotRequest;
use App\Http\Requests\User\SyncRolesRequest;
use App\Http\Requests\User\ToggleRolesRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Many To Many, user side: User belongsToMany Role.
 */
class UserRoleController extends Controller
{
    /**
     * List users with their roles, optionally filtered with ?role=admin or ?has_roles=0.
     */
    public function index(Request $request, ListUsersWithRoles $action): JsonResponse
    {
        $role = $request->has('role') ? $request->string('role')->toString() : null;
        $hasRoles = $request->has('has_roles') ? $request->boolean('has_roles') : null;

        return $this->success($action->execute($role, $hasRoles));
    }

    /**
     * List the roles of a user with their pivot columns.
     */
    public function show(User $user, ShowUserRoles $action): JsonResponse
    {
        return $this->success($action->execute($user));
    }

    /**
     * Filter the roles of a user with ?status=permanent, expiring or expired.
     */
    public function byPivot(Request $request, User $user, ListUserRolesByPivot $action): JsonResponse
    {
        return $this->success($action->execute($user, $request->string('status')->toString()));
    }

    /**
     * Check if the user has a role with ?name=admin.
     */
    public function hasRole(Request $request, User $user, CheckUserHasRole $action): JsonResponse
    {
        return $this->success(['has_role' => $action->execute($user, $request->string('name')->toString())]);
    }

    /**
     * Add a role to the user with attach().
     */
    public function attach(AttachRoleRequest $request, User $user, AttachRoleToUser $action): JsonResponse
    {
        $roles = $action->execute($user, $request->integer('role_id'), $request->input('expires_at'));

        return $this->created($roles, 'Role attached.');
    }

    /**
     * Remove one role from the user with detach().
     */
    public function detach(User $user, int $role, DetachRoleFromUser $action): JsonResponse
    {
        return $this->success(['detached' => $action->execute($user, $role)], 'Role detached.');
    }

    /**
     * Remove every role from the user with detach().
     */
    public function detachAll(User $user, DetachRoleFromUser $action): JsonResponse
    {
        return $this->success(['detached' => $action->execute($user)], 'All roles detached.');
    }

    /**
     * Make the roles of the user match the given list with sync().
     */
    public function sync(SyncRolesRequest $request, User $user, SyncUserRoles $action): JsonResponse
    {
        return $this->success($action->execute($user, $request->validated('roles')), 'Roles synced.');
    }

    /**
     * Add the given roles without removing any with syncWithoutDetaching().
     */
    public function syncWithoutDetaching(SyncRolesRequest $request, User $user, SyncUserRolesWithoutDetaching $action): JsonResponse
    {
        return $this->success($action->execute($user, $request->validated('roles')), 'Roles synced.');
    }

    /**
     * Toggle the given roles with toggle().
     */
    public function toggle(ToggleRolesRequest $request, User $user, ToggleUserRoles $action): JsonResponse
    {
        return $this->success($action->execute($user, $request->validated('role_ids')), 'Roles toggled.');
    }

    /**
     * Change the expires_at pivot value with updateExistingPivot().
     */
    public function updatePivot(PivotRequest $request, User $user, int $role, UpdateUserRolePivot $action): JsonResponse
    {
        return $this->success($action->execute($user, $role, $request->input('expires_at')), 'Pivot updated.');
    }
}