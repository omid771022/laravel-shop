<?php

namespace App\Providers;


use App\Repositories\RoleRepo;
use App\Repositories\UserRepo;
use App\Repositories\CategoryRepo;
use App\Repositories\RoleRepoInterface;
use App\Repositories\UserRepoInterface;
use App\Repositories\CategoryRepoInterface;
use Illuminate\Support\ServiceProvider;


class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        app()->bind(RoleRepoInterface::class, RoleRepo::class);
        app()->bind(UserRepoInterface::class, UserRepo::class);
        app()->bind(CategoryRepoInterface::class, CategoryRepo::class);
    }
}