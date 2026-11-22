<?php

declare(strict_types=1);

namespace App\Http\Controllers\Mechanic;

use App\Actions\Mechanic\CheckMechanicHasOwner;
use App\Actions\Mechanic\CreateMechanicCar;
use App\Actions\Mechanic\DeleteMechanicOwner;
use App\Actions\Mechanic\ListMechanicsWithOwner;
use App\Actions\Mechanic\SearchMechanicsByOwnerName;
use App\Actions\Mechanic\ShowMechanicCar;
use App\Actions\Mechanic\ShowMechanicOwner;
use App\Actions\Mechanic\ShowMechanicOwnerFluently;
use App\Actions\Mechanic\UpdateMechanicOwner;
use App\Http\Controllers\Controller;
use App\Http\Requests\Car\CarRequest;
use App\Http\Requests\Owner\OwnerRequest;
use App\Models\Mechanic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Has One Through, parent side: Mechanic hasOneThrough Owner through Car.
 */
class MechanicOwnerController extends Controller
{
    /**
     * List mechanics with their owner, optionally filtered with ?has_owner=1 or ?has_owner=0.
     */
    public function index(Request $request, ListMechanicsWithOwner $action): JsonResponse
    {
        $hasOwner = $request->has('has_owner') ? $request->boolean('has_owner') : null;

        return $this->success($action->execute($hasOwner));
    }

    /**
     * Search mechanics by the name of the car owner.
     */
    public function search(Request $request, SearchMechanicsByOwnerName $action): JsonResponse
    {
        return $this->success($action->execute($request->string('name')->toString()));
    }

    /**
     * Show the owner of the mechanic's car.
     */
    public function show(Mechanic $mechanic, ShowMechanicOwner $action): JsonResponse
    {
        return $this->success($action->execute($mechanic));
    }

    /**
     * Show the owner with the fluent through() syntax.
     */
    public function fluent(Mechanic $mechanic, ShowMechanicOwnerFluently $action): JsonResponse
    {
        return $this->success($action->execute($mechanic));
    }

    /**
     * Check if the mechanic reaches an owner.
     */
    public function exists(Mechanic $mechanic, CheckMechanicHasOwner $action): JsonResponse
    {
        return $this->success(['has_owner' => $action->execute($mechanic)]);
    }

    /**
     * Show the intermediate car of the mechanic.
     */
    public function car(Mechanic $mechanic, ShowMechanicCar $action): JsonResponse
    {
        return $this->success($action->execute($mechanic));
    }

    /**
     * Create the intermediate car of the mechanic.
     */
    public function createCar(CarRequest $request, Mechanic $mechanic, CreateMechanicCar $action): JsonResponse
    {
        return $this->created($action->execute($mechanic, $request->validated()), 'Car created.');
    }

    /**
     * Update the owner reached through the car.
     */
    public function update(OwnerRequest $request, Mechanic $mechanic, UpdateMechanicOwner $action): JsonResponse
    {
        return $this->success($action->execute($mechanic, $request->validated()), 'Owner updated.');
    }

    /**
     * Delete the owner reached through the car.
     */
    public function destroy(Mechanic $mechanic, DeleteMechanicOwner $action): JsonResponse
    {
        return $this->success(['deleted' => $action->execute($mechanic)], 'Owner deleted.');
    }
}