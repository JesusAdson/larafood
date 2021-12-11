<?php

namespace App\Providers;

use App\Models\{
    Plan,
    DetailPlan,
};
use App\Contracts\{
    Plans\PlansRepositoryInterface,
    Profiles\ProfilesRepositoryInterface,
    Plans\DetailsPlanRepositoryInterface,
    Permissions\PermissionsRepositoryInterface
};
use App\Observers\{
    PlanObserver
};

use App\Repositories\{
    Plans\PlansRepository,
    Profiles\ProfilesRepository,
    Plans\DetailsPlanRepository,
    Permissions\PermissionsRepository
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
        $this->app->bind(DetailsPlanRepositoryInterface::class, DetailsPlanRepository::class);
        $this->app->bind(ProfilesRepositoryInterface::class, ProfilesRepository::class);
        $this->app->bind(PermissionsRepositoryInterface::class, PermissionsRepository::class);
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
