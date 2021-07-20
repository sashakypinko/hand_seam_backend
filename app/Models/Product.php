<?php

namespace App\Models;

use App\Traits\FileTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static withCount(\Closure[] $array)
 */
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

    /**
     * @var string[]
     */
    protected $appends = [
        'image',
        'primary_photo',
        'secondary_photo'
    ];

    /**
     * @return HasMany
     */
    public function product_photos(): HasMany
    {
        return $this->hasMany(ProductPhoto::class);
    }

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    /**
     * @return BelongsToMany
     */
    public function sizes(): BelongsToMany
    {
        return $this->belongsToMany(Size::class, 'product_sizes');
    }

    /**
     * @return BelongsToMany
     */
    public function related_products(): BelongsToMany
    {
        return $this->belongsToMany(
            self::class,
            'product_relations',
            'product_id',
            'related_product_id'
        );
    }

    /**
     * @return HasMany
     */
    public function statistics(): HasMany
    {
        return $this->hasMany(Statistic::class);
    }

    /**
     * @return BelongsTo
     */
    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class);
    }

    /**
     * @return string
     */
    public function getPrimaryPhotoAttribute(): string
    {
        $photo = $this->product_photos->filter(function ($item) {
            return $item->type === ProductPhoto::TYPE_PRIMARY;
        })->first();

        return self::getImagePath($photo->photo ?? '');
    }

    /**
     * @return string
     */
    public function getSecondaryPhotoAttribute(): string
    {
        $photo = $this->product_photos->filter(function ($item) {
            return $item->type === ProductPhoto::TYPE_SECONDARY;
        })->first();

        return self::getImagePath($photo->photo ?? '');
    }

    /**
     * @return mixed|null
     */
    public function getPhotoAttribute()
    {
        return $this->product_photos[0]['photo'] ?? null;
    }

    /**
     * @return mixed|null
     */
    public function getImageAttribute()
    {
        return $this->product_photos[0]['photo'] ?? null;
    }
}
