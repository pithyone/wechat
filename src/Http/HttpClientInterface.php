<?php

namespace WeWork\Http;

use Psr\Http\Message\StreamInterface;

interface HttpClientInterface
{
    /**
     * @param string $uri
     * @param array $query
     * @return array
     */
    public function get(string $uri, array $query = []): array;

    /**
     * @param string $uri
     * @param array $query
     * @return StreamInterface
     */
    public function getStream(string $uri, array $query = []): StreamInterface;

    /**
     * @param string $uri
     * @param array $json
     * @param array $query
     * @return array
     */
    public function postJson(string $uri, array $json = [], array $query = []): array;

    /**
     * @param string $uri
     * @param string $path
     * @param array $query
     * @return array
     */
    public function postFile(string $uri, string $path, array $query = []): array;
}
