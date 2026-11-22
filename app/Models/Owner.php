<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Owner extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id',
        'name',
    ];

    /**
     * Get the car owned by the owner.
     */
    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }
}
