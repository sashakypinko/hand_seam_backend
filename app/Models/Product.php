<?php

namespace App\Models;

use App\Traits\FileTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{

    use FileTrait;

    public const STATUS_INACTIVE = 0;
    public const STATUS_ACTIVE = 1;
    public const STATUS_SALE = 2;

    public const GENDER_MALE = 1;
    public const GENDER_FEMALE = 2;

    public const MAX_ITEMS = 6;

    public const GENDERS = [
        self::GENDER_MALE => 'Male',
        self::GENDER_FEMALE => 'Female'
    ];

    public const STATUSES = [
        self::STATUS_INACTIVE => 'Inactive',
        self::STATUS_ACTIVE => 'Active',
        self::STATUS_SALE => 'Sale',
    ];

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'price',
        'old_price',
        'description',
        'category_id',
        'type_id',
        'color_id',
        'gender',
        'status'
    ];

    protected $appends = [
        'image'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function product_photos(): HasMany
    {
        return $this->hasMany(ProductPhoto::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_sizes');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function color(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Color::class);
    }

    public function getPrimaryPhotoAttribute()
    {
        return $this->product_photos->filter(function ($item) {
            return $item->type === ProductPhoto::TYPE_PRIMARY;
        })->first();
    }

    public function getSecondaryPhotoAttribute()
    {
        return $this->product_photos->filter(function ($item) {
            return $item->type === ProductPhoto::TYPE_SECONDARY;
        })->first();
    }

    public function getPhotoAttribute()
    {
        return $this->product_photos[0]['photo'] ?? null;
    }
}
