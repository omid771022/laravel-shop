<?php

namespace App\Providers;


use App\Repositories\RoleRepo;
use App\Repositories\UserRepo;
use App\Repositories\MediaRepo;
use App\Repositories\CouresRepo;
use App\Repositories\LessonRepo;
use App\Repositories\SeasonRepo;

use App\Repositories\CategoryRepo;
use App\Repositories\PermissionRepo;
use App\Repositories\RoleRepoInterface;
use App\Repositories\UserRepoInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\MediaRepoInterface;
use App\Repositories\CouresRepoInterface;
use App\Repositories\LessonRepoInterface;
use App\Repositories\SeasonRepoInterface;
use App\Repositories\CategoryRepoInterface;
use App\Repositories\PermissionRepoInterface;

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
        app()->bind(PermissionRepoInterface::class, PermissionRepo::class);
        app()->bind(CouresRepoInterface::class, CouresRepo::class);
        app()->bind(SeasonRepoInterface::class, SeasonRepo::class);
        app()->bind(LessonRepoInterface::class, LessonRepo::class);
        app()->bind(MediaRepoInterface::class, MediaRepo::class);
    }
}
