<?php

namespace Tests\Unit\NytApi\Transport;

use App\NytApi\Transport\HttpTransport;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class HttpTransportTest extends TestCase
{
    public function test_get(): void
    {
        Http::fake([
            'https://example.com/path?param=value&api-key=api-key' => Http::response('response', 200),
        ]);
        $transport = new HttpTransport('api-key', 'https://example.com');
        $response = $transport->get('/path', ['param' => 'value']);
        $this->assertSame('response', $response);
    }

    public function test_http_error()
    {
        Http::fake([
            'https://example.com/path?param=value&api-key=api-key' => Http::response('response', 404),
        ]);
        $transport = new HttpTransport('api-key', 'https://example.com');
        $this->expectExceptionMessage('response');
        $this->expectExceptionCode(404);
        $transport->get('/path', ['param' => 'value']);
    }
}
