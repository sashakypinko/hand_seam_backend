<?php

namespace App\Models;

use App\ModelScopes\DiscountScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Discount extends Model
{

    public const TRIGGER_VISIT = 1;
    public const TRIGGER_PAYMENT = 2;

    public const CODE_ACTIVE_DAYS_DEFAULT = 1;
    public const AVAILABLE_CODE_COUNT = 10;

    public const STATUS_ACTIVE = 1;
    public const STATUS_INACTIVE = 0;

    public const TRIGGERS = [
        self::TRIGGER_VISIT => 'VISIT',
        self::TRIGGER_PAYMENT => 'PAYMENT',
    ];

    public const STATUSES = [
        self::STATUS_ACTIVE => 'Active',
        self::STATUS_INACTIVE => 'Inactive',
    ];

    /**
     * @var string[]
     */
    protected $fillable = [
        'title',
        'description',
        'amount',
        'trigger',
        'start_date',
        'end_date',
        'code_active_days',
        'available_code_count',
        'status'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime'
    ];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new DiscountScope);
    }

    /**
     * @return HasMany
     */
    public function codes(): HasMany
    {
        return $this->hasMany(DiscountCode::class);
    }
}
