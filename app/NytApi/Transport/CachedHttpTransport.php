<?php

namespace App\NytApi\Transport;

use Illuminate\Support\Facades\Cache;

class CachedHttpTransport extends HttpTransport
{
    public function __construct(string $apiKey, string $host, private readonly int $cacheTTL)
    {
        parent::__construct($apiKey, $host);
    }

    public function get(string $url, array $data): string
    {
        if (!($response = $this->getFromCache($data))) {
            $response = parent::get($url, $data);
            $this->putToCache($data, $response);
        }
        return $response;
    }

    private function makeCacheKey(array $requestData): string
    {
        return hash('sha256', json_encode($requestData));
    }

    private function getFromCache(array $requestData): ?string
    {
        $cacheKey = $this->makeCacheKey($requestData);
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }
        return null;
    }

    private function putToCache(array $requestData, string $response): void
    {
        $cacheKey = $this->makeCacheKey($requestData);
        Cache::put($cacheKey, $response, $this->cacheTTL);
    }
}
