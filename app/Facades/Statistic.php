<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;


/**
 * @method static clicked(int $productId)
 * @method static addedToCart(int $productId)
 * @method static addedToFavorites(int $productId)
 * @method static paid(int $productId)
 */
class Statistic extends Facade
{

    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'statistic';
    }
}
