<?php

namespace App\Providers;

use App\Category;
use App\Policies\CoursePolicy;
use App\Policies\CategoryPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::policy(Course::class, CoursePolicy::class);
        Gate::policy(Category::class , CategoryPolicy::class);

        Gate::before(function ($user) {
            return $user->hasPermissionTo('super admin') ? true : null;
        });
    }
}
