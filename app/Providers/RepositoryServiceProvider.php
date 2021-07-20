<?php

namespace App\Providers;

use App\Repositories\ActionType\ActionTypeRepository;
use App\Repositories\CartItem\CartItemRepository;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Client\ClientRepository;
use App\Repositories\Color\ColorRepository;
use App\Repositories\Discount\DiscountRepository;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Size\SizeRepository;
use App\Repositories\Statistic\StatisticRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProductRepository::class, \App\Repositories\Product\Eloquent::class);
        $this->app->bind(CategoryRepository::class, \App\Repositories\Category\Eloquent::class);
        $this->app->bind(ColorRepository::class, \App\Repositories\Color\Eloquent::class);
        $this->app->bind(SizeRepository::class, \App\Repositories\Size\Eloquent::class);
        $this->app->bind(CartItemRepository::class, \App\Repositories\CartItem\Eloquent::class);
        $this->app->bind(DiscountRepository::class, \App\Repositories\Discount\Eloquent::class);
        $this->app->bind(ClientRepository::class, \App\Repositories\Client\Eloquent::class);
        $this->app->bind(StatisticRepository::class, \App\Repositories\Statistic\Eloquent::class);
        $this->app->bind(ActionTypeRepository::class, \App\Repositories\ActionType\Eloquent::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
