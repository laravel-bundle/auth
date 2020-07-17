<?php

namespace LaravelBundle\Auth\Shared\Infrastructure\Http\Request;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use stdClass;

/**
 * Class GuzzleClient
 *
 * @package LaravelBundle\Auth\Shared\Infrastructure\Http
 */
class GuzzleClient implements HttpClient
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Send http request.
     *
     * @param string $method
     * @param string $uri
     * @param array $body
     * @param array $options
     * @return stdClass
     * @throws GuzzleException
     */
    public function send(string $method, string $uri, array $body = [], array $options = []): stdClass
    {
        $response = $this->client->request($method, $uri, $options);

        return json_decode($response->getBody());
    }
}
