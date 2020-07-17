<?php

namespace LaravelBundle\Auth\Shared\Application\Providers;

use Illuminate\Support\ServiceProvider;
use LaravelBundle\Auth\Shared\Infrastructure\Http\Request\{
    HttpClient as HttpClientContract,
    GuzzleClient
};

/**
 * Class BindServiceProvider
 *
 * @package LaravelBundle\Auth\Shared\Application\Providers
 */
class BindServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(HttpClientContract::class, GuzzleClient::class);
    }
}
