<?php

namespace LaravelBundle\Auth\Shared\Infrastructure\Http\Request;

use stdClass;

/**
 * Interface HttpClient
 *
 * @package LaravelBundle\Auth\Shared\Infrastructure\Http
 */
interface HttpClient
{
    /**
     * Send http request.
     *
     * @param string $method
     * @param string $uri
     * @param array $body
     * @param array $options
     * @return stdClass
     */
    public function send(string $method, string $uri, array $body = [], array $options = []): stdClass;
}
