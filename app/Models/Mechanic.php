<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Mechanic extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /**
     * Get the car the mechanic is working on.
     */
    public function car(): HasOne
    {
        return $this->hasOne(Car::class);
    }

    /**
     * Get the owner of the car the mechanic is working on.
     */
    public function owner(): HasOneThrough
    {
        return $this->hasOneThrough(Owner::class, Car::class);
    }
}
