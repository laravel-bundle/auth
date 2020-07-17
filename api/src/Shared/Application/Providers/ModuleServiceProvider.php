<?php

namespace LaravelBundle\Auth\Shared\Application\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class ModuleServiceProvider
 *
 * @package LaravelBundle\Auth\Shared\Application\Providers
 */
class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->register(BindServiceProvider::class);
    }
}
