<?php

namespace Tests\Unit\NytApi\Transport;

use App\NytApi\Transport\CachedHttpTransport;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class CachedHttpTransportTest extends TestCase
{
    public function test_get(): void
    {
        Http::fake([
            'https://example.com/path?param=value&api-key=api-key' => Http::response('response', 200),
        ]);
        $cacheKey = hash('sha256', json_encode(['param' => 'value']));
        Cache::shouldReceive('has')->once()->with($cacheKey)->andReturn(false);
        Cache::shouldReceive('put')->once()->with($cacheKey, 'response', 60);
        $transport = new CachedHttpTransport('api-key', 'https://example.com', 60);
        $response = $transport->get('/path', ['param' => 'value']);
        $this->assertSame('response', $response);
    }

    public function test_get_from_cache()
    {
        $cacheKey = hash('sha256', json_encode(['param' => 'value']));
        Cache::shouldReceive('has')->once()->with($cacheKey)->andReturn(true);
        Cache::shouldReceive('get')->once()->with($cacheKey)->andReturn('response');
        $transport = new CachedHttpTransport('api-key', 'https://example.com', 60);
        $response = $transport->get('/path', ['param' => 'value']);
        $this->assertSame('response', $response);
    }
}
