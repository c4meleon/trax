<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(array $all)
 */
class Car extends Model
{
    protected $fillable = [
        'make', 'model', 'year',
    ];

    protected $appends = ['trip_miles', 'trip_count'];

    public function trips(): HasMany
    {
        return $this->hasMany(Trip::class, 'id', 'car_id');
    }

    public function getTripMilesAttribute(): float
    {
        return $this->trips()->max('total') ?? 0;
    }

    public function getTripCountAttribute(): int
    {
        return $this->trips()->count();
    }
}
