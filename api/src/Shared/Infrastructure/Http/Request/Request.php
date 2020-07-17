<?php

namespace LaravelBundle\Auth\Shared\Infrastructure\Http\Request;

use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\RequestOptions;
use LaravelBundle\Auth\Shared\Infrastructure\Http\Request\Exceptions\RequestFailureException;
use Psr\Log\LoggerInterface;
use stdClass;

/**
 * Class Request
 *
 * @package LaravelBundle\Auth\Shared\Infrastructure\Http
 */
abstract class Request
{
    private const HTTP_METHOD_GET  = 'GET';
    private const HTTP_METHOD_POST = 'POST';
    private const HTTP_METHOD_PUT  = 'PUT';

    private HttpClient $client;
    private LoggerInterface $logger;

    public function __construct(HttpClient $client, LoggerInterface $logger)
    {
        $this->client = $client;
        $this->logger = $logger;
    }

    /**
     * Http method post request.
     *
     * @param array $payload
     * @param array $options
     * @return stdClass
     * @throws RequestFailureException
     */
    public function get(array $payload, array $options = []): stdClass
    {
        return $this->send(self::HTTP_METHOD_GET, $payload, $options);
    }

    /**
     * Http method post request.
     *
     * @param array $payload
     * @param array $options
     * @return stdClass
     * @throws RequestFailureException
     */
    public function post(array $payload, array $options = []): stdClass
    {
        return $this->send(self::HTTP_METHOD_POST, $payload, $options);
    }

    /**
     * Http method put request.
     *
     * @param array $payload
     * @param array $options
     * @return stdClass
     * @throws RequestFailureException
     */
    public function put(array $payload, array $options = []): stdClass
    {
        return $this->send(self::HTTP_METHOD_PUT, $payload, $options);
    }

    /**
     * Send request.
     *
     * @param string $method
     * @param array $payload
     * @param array $options
     * @return stdClass
     * @throws RequestFailureException
     */
    private function send(string $method, array $payload = [], array $options = []): stdClass
    {
        $default = [
            'headers' => [
                HeaderOptions::ACCEPT        => 'application/json',
                HeaderOptions::CONTENT_TYPE  => 'application/json',
            ],
            RequestOptions::TIMEOUT => $this->timeout(),
            RequestOptions::JSON => $payload
        ];

        $options = array_merge_recursive($default, $options);

        try {
            return $this->client->send(
                $method,
                $this->url(),
                $payload,
                $options
            );
        } catch (RequestException $e) {
            $this->logger->error('Request-Failure', [
                'url' => $this->url(),
                'method' => $method,
                'payload' => $payload,
                'exception' => $e
            ]);

            throw new RequestFailureException();
        }
    }

    /**
     * Optional timeout configuration for the request.
     *
     * @return float
     */
    protected function timeout(): float
    {
        return 0;
    }

    /**
     * Get url.
     *
     * @return string
     */
    abstract protected function url(): string;
}
