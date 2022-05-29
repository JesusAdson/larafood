<?php

namespace App\Providers;

use App\Models\{
    Category,
    Plan,
    DetailPlan,
    Tenant,
};
use App\Contracts\{
    Plans\PlansRepositoryInterface,
    Profiles\ProfilesRepositoryInterface,
    Plans\DetailsPlanRepositoryInterface,
    Permissions\PermissionsRepositoryInterface,
    Tenants\TenantsRepositoryInterface,
    Users\UsersRepositoryInterface,
    Categories\CategoriesRepositoryInterface,
};
use App\Observers\{
    PlanObserver,
    TenantObserver,
    CategoryObserver
};

use App\Repositories\{
    Plans\PlansRepository,
    Profiles\ProfilesRepository,
    Plans\DetailsPlanRepository,
    Permissions\PermissionsRepository,
    Tenants\TenantsRepository,
    Users\UsersRepository,
    Categories\CategoriesRepository
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
        $this->app->bind(TenantsRepositoryInterface::class, TenantsRepository::class);
        $this->app->bind(UsersRepositoryInterface::class, UsersRepository::class);
        $this->app->bind(CategoriesRepositoryInterface::class, CategoriesRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Plan::observe(PlanObserver::class);
        Tenant::observe(TenantObserver::class);
        Category::observe(CategoryObserver::class);
    }
}
