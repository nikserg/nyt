<?php

namespace App\NytApi\Transport;

use App\NytApi\Exceptions\TransportException;
use Illuminate\Support\Facades\Http;

class HttpTransport implements TransportInterface
{
    public function __construct(private readonly string $apiKey, private readonly string $host)
    {
    }

    public function get(string $url, array $data): string
    {
        $data['api-key'] = $this->apiKey;
        $response = Http::get($this->host . $url, $data);
        if ($response->failed()) {
            throw new TransportException('API error: ' . $response->body(), $response->status());
        }
        return $response->body();
    }
}
