<?php

namespace App\Providers;

use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Pagination\LengthAwarePaginator;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $paginator = new AbstractPaginator();
        $paginator->onEachSide(1);
        Paginator::useBootstrap();
    }
}
