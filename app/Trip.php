<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @method static create(array $all)
 * @method static where(string $string, mixed $input)
 * @method latest()
 */
class Trip extends Model
{
    protected $fillable = [
        'date', 'miles', 'total', 'car_id',
    ];

    protected $dates = [
        'date'
    ];

    protected $casts = [
        'date' => 'date:m/d/Y',
    ];

    public function car(): HasOne
    {
        return $this->hasOne(Car::class, 'id', 'car_id');
    }
}
