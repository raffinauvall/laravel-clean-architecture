<?php

namespace App\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;

class CleanArchitectureServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Registrasi dependency atau layanan di sini
        // Contoh:
        // $this->app->bind('App\Infrastructure\Repositories\UserRepository', 'App\Infrastructure\Repositories\EloquentUserRepository');
    }
}
