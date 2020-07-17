<?php

namespace LaravelBundle\Auth\Shared\Infrastructure\Api;

use Illuminate\Routing\Router as LaravelRouter;

/**
 * Class Route
 *
 * @package LaravelBundle\Auth\Shared\UI\Api
 */
abstract class Router
{
    protected array $options;
    protected LaravelRouter $router;

    /**
     * Router constructor.
     *
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $this->options = $options;
        $this->router = app('router');
    }

    /**
     * Define routes
     *
     * @return void
     */
    public function register(): void
    {
        $this->router->group($this->options, function () {
            $this->routes();
        });
    }

    /**
     * Set routes
     *
     * @return void
     */
    abstract protected function routes();
}
