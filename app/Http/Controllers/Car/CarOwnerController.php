<?php

declare(strict_types=1);

namespace App\Http\Controllers\Car;

use App\Actions\Car\CreateCarOwner;
use App\Http\Controllers\Controller;
use App\Http\Requests\Owner\OwnerRequest;
use App\Models\Car;
use Illuminate\Http\JsonResponse;

/**
 * Has One Through, intermediate side: Car hasOne Owner.
 */
class CarOwnerController extends Controller
{
    /**
     * Create the owner of a car.
     */
    public function create(OwnerRequest $request, Car $car, CreateCarOwner $action): JsonResponse
    {
        return $this->created($action->execute($car, $request->validated()), 'Owner created.');
    }
}