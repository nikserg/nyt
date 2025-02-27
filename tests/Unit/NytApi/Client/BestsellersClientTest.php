<?php

namespace Tests\Unit\NytApi\Client;

use App\NytApi\Client\BestsellersClient;
use App\NytApi\Exceptions\FailResponseException;
use App\NytApi\Response\Book;
use App\NytApi\Transport\TransportInterface;
use PHPUnit\Framework\TestCase;

class BestsellersClientTest extends TestCase
{
    public function test_index(): void
    {
        $data = ['key' => 'value'];
        $response = '{
            "status": "OK",
            "results": [
                {
                    "title": "The Testaments",
                    "author": "Margaret Atwood"
                    }
                ]
            }';
        $transport = $this->createMock(TransportInterface::class);
        $transport->expects($this->once())
            ->method('get')
            ->with('svc/books/v3/lists/best-sellers/history.json', $data)
            ->willReturn($response);
        $client = new BestsellersClient($transport);
        $books = $client->index($data);
        $this->assertCount(1, $books);
        $this->assertInstanceOf(Book::class, $books[0]);
        $this->assertEquals('The Testaments', $books[0]->title);
        $this->assertEquals('Margaret Atwood', $books[0]->author);
    }

    public function test_invalid_response(): void
    {
        $this->expectException(FailResponseException::class);
        $this->expectExceptionMessage('Response status is not OK: {"status":"ERROR","results":[]}');
        $data = ['key' => 'value'];
        $response = '{
            "status": "ERROR",
            "results": []
            }';
        $transport = $this->createMock(TransportInterface::class);
        $transport->expects($this->once())
            ->method('get')
            ->with('svc/books/v3/lists/best-sellers/history.json', $data)
            ->willReturn($response);
        $client = new BestsellersClient($transport);
        $client->index($data);
    }
}
