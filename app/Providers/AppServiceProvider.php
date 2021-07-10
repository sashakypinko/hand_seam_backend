<?php

namespace App\Providers;

use App\Services\Cart\CartService;
use App\Services\Cart\CartServiceInterface;
use App\Services\Category\CategoryService;
use App\Services\Category\CategoryServiceInterface;
use App\Services\Color\ColorService;
use App\Services\Color\ColorServiceInterface;
use App\Services\Product\ProductService;
use App\Services\Product\ProductServiceInterface;
use App\Services\Size\SizeServiceInterface;
use App\Services\Size\SizeService;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProductServiceInterface::class, ProductService::class);
        $this->app->bind(CategoryServiceInterface::class, CategoryService::class);
        $this->app->bind(ColorServiceInterface::class, ColorService::class);
        $this->app->bind(SizeServiceInterface::class, SizeService::class);
        $this->app->bind(CartServiceInterface::class, CartService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
