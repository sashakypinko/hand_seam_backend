<?php

namespace App\Models;

use App\ModelScopes\UserScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DiscountCode extends Model
{

    public const STATUS_ACTIVE = 1;
    public const STATUS_EXPIRED = 0;

    /**
     * @var string[]
     */
    protected $fillable = [
        'discount_id',
        'client_id',
        'code',
        'status'
    ];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new UserScope);
    }

    /**
     * @return BelongsTo
     */
    public function discount(): BelongsTo
    {
        return $this->belongsTo(Discount::class)->withoutGlobalScopes();
    }
}
