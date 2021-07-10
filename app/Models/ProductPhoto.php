<?php

namespace App\Models;

use App\Traits\FileTrait;
use Illuminate\Database\Eloquent\Model;

class ProductPhoto extends Model
{

    use FileTrait;

    public const TYPE_PRIMARY = 1;
    public const TYPE_SECONDARY = 2;
    public const TYPE_OTHER = 3;

    const TYPES = [
        self::TYPE_PRIMARY => 'Primary',
        self::TYPE_SECONDARY => 'Secondary',
        self::TYPE_OTHER => 'Other'
    ];

    protected $fillable = [
        'product_id',
        'photo',
        'type'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
