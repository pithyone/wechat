<?php

namespace WeWork\Http;

use GuzzleHttp\Client;
use Psr\Http\Message\StreamInterface;

class HttpClient implements HttpClientInterface
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $uri
     * @param array $query
     * @return array
     */
    public function get(string $uri, array $query = []): array
    {
        return $this->client->get($uri, compact('query'))->toArray();
    }

    /**
     * @param string $uri
     * @param array $query
     * @return StreamInterface
     */
    public function getStream(string $uri, array $query = []): StreamInterface
    {
        return $this->client->get($uri, compact('query'))->getBody();
    }

    /**
     * @param string $uri
     * @param array $json
     * @param array $query
     * @return array
     */
    public function postJson(string $uri, array $json = [], array $query = []): array
    {
        return $this->client->post($uri, compact('json', 'query'))->toArray();
    }

    /**
     * @param string $uri
     * @param string $path
     * @param array $query
     * @return array
     */
    public function postFile(string $uri, string $path, array $query = []): array
    {
        return $this->client->post($uri, array_merge([
            'multipart' => [
                [
                    'name' => 'media',
                    'contents' => fopen($path, 'r')
                ]
            ]
        ], compact('query')))->toArray();
    }
}
