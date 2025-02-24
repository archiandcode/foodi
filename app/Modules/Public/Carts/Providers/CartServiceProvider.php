<?php

namespace App\Modules\Public\Carts\Providers;

use App\Modules\Public\Carts\Contracts\CartItemRepoInterface;
use App\Modules\Public\Carts\Contracts\CartRepoInterface;
use App\Modules\Public\Carts\Repositories\CartItemRepo;
use App\Modules\Public\Carts\Repositories\CartRepo;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CartItemRepoInterface::class, CartItemRepo::class);
        $this->app->bind(CartRepoInterface::class, CartRepo::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
