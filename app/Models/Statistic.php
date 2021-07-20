<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method create(array $array)
 * @method static select(string $string)
 * @method static selectRaw(string $string)
 */
class Statistic extends Model
{

    /**
     * @var string[]
     */
    protected $fillable = [
        'client_id',
        'product_id',
        'action_type_id'
    ];

    /**
     * @return BelongsTo
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @return BelongsTo
     */
    public function actionType(): BelongsTo
    {
        return $this->belongsTo(ActionType::class);
    }
}
