<?php

namespace App\Providers;

use App\Interface\CartRepositoryInterface;
use App\Interface\OrderRepositoryInterface;
use App\Repository\CartRepository;
use App\Repository\OrderRepository;
use Illuminate\Pagination\Paginator;
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
        $this->app->bind(
            CartRepositoryInterface::class,
            CartRepository::class,

        );


        $this->app->bind(
            OrderRepositoryInterface::class,
            OrderRepository::class,

        );

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrapFive();
    }
}
