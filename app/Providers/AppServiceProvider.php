<?php

namespace App\Providers;

use App\Models\{
    Plan
};
use App\Contracts\{
    Plans\PlansRepositoryInterface
};
use App\Observers\PlanObserver;
use App\Repositories\{
    Plans\PlansRepository
};


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
        $this->app->bind(PlansRepositoryInterface::class, PlansRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Plan::observe(PlanObserver::class);
    }
}
