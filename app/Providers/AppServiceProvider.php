<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $repositories = [
            'Author',
            'Book',
            'Medium',
            'Publisher',
            'Shelf',
            'Tag'
        ];

        // Bind interfaces and repositories
        foreach ($repositories as $repository) {
            $this->app->bind(
                "App\\Repositories\\{$repository}\\{$repository}Interface",
                "App\\Repositories\\{$repository}\\{$repository}EloquentRepository"
            );
        }


    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Register IDE helper for dev enviroment
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }
}
