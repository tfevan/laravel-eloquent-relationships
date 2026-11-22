<?php

declare(strict_types=1);

namespace App\Http\Controllers\Owner;

use App\Actions\Owner\ListOwnersByMechanic;
use App\Actions\Owner\ListOwnersWithMechanic;
use App\Actions\Owner\ShowOwnerMechanic;
use App\Http\Controllers\Controller;
use App\Models\Mechanic;
use App\Models\Owner;
use Illuminate\Http\JsonResponse;

/**
 * Has One Through, reverse side: Owner back to Mechanic through Car.
 */
class OwnerMechanicController extends Controller
{
    /**
     * List owners with their car and mechanic.
     */
    public function index(ListOwnersWithMechanic $action): JsonResponse
    {
        return $this->success($action->execute());
    }

    /**
     * List the owners of the cars a mechanic works on.
     */
    public function byMechanic(Mechanic $mechanic, ListOwnersByMechanic $action): JsonResponse
    {
        return $this->success($action->execute($mechanic));
    }

    /**
     * Show the mechanic of an owner's car.
     */
    public function show(Owner $owner, ShowOwnerMechanic $action): JsonResponse
    {
        return $this->success($action->execute($owner));
    }
}