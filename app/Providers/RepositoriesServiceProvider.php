<?php

namespace App\Providers;

use App\Repositories\User\ChatRepository;
use App\Repositories\User\ChatRepositoryImterface;
use App\Repositories\User\GroupRepository;
use App\Repositories\User\GroupRepositoryImterface;
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
        $this->app->bind(ChatRepositoryImterface::class, ChatRepository::class);
        $this->app->bind(GroupRepositoryImterface::class, GroupRepository::class);
    }
}
