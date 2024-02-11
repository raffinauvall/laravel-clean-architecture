<?php

namespace App\Providers;

use App\Application\Usecases\Create\CreateUserUsecase;
use App\Application\Usecases\Create\Interactors\CreateUserInteractor;
use App\Application\UseCases\Read\Interactors\ReadUserInteractor;
use App\Application\Usecases\Read\ReadUserUsecase;
use App\Domain\Repositories\EloquentUserRepository;
use App\Domain\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(CreateUserUsecase::class, CreateUserInteractor::class);
        $this->app->bind(ReadUserUsecase::class, ReadUserInteractor::class);
        $this->app->bind(UserRepository::class, EloquentUserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
