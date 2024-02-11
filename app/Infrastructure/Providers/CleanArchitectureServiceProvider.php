<?php

namespace App\Infrastructure\Providers;

use App\Application\Usecases\Create\CreateUserUsecase;
use App\Application\Usecases\Create\Interactors\CreateUserInteractor;
use App\Application\UseCases\Read\Interactors\ReadUserInteractor;
use App\Application\Usecases\Read\ReadUserUsecase;
use Illuminate\Support\ServiceProvider;

class CleanArchitectureServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Registrasi dependency atau layanan di sini
        // Contoh:

        $this->app->singleton(CreateUserUsecase::class, CreateUserInteractor::class);
        $this->app->bind(ReadUserUsecase::class, ReadUserInteractor::class);
        $this->app->bind('App\Infrastructure\Repositories\UserRepository', 'App\Infrastructure\Repositories\EloquentUserRepository');
    }
}
