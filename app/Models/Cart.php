<?php

namespace App\Models;

use App\ModelScopes\UserScope;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{

    /**
     * @var string[]
     */
    protected $fillable = [
        'product_id',
        'visitor_id',
        'size_id',
        'count'
    ];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new UserScope);
    }

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class)->with('product_photos');
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function size(): BelongsTo
    {
        return $this->belongsTo(Size::class);
    }

    /**
     * @return BelongsTo
     */
    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class);
    }

}
