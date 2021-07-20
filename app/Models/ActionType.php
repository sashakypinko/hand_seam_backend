<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method whereType(string $type)
 */
class ActionType extends Model
{

    /**
     * @var string[]
     */
    protected $fillable = [
        'type',
        'factor'
    ];

    /**
     * @return HasMany
     */
    protected function statistics(): HasMany
    {
        return $this->hasMany(Statistic::class);
    }
}
