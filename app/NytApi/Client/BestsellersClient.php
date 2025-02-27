<?php

namespace App\NytApi\Client;

use App\NytApi\Response\Book;

class BestsellersClient extends AbstractClient
{
    /**
     * @return Book[]
     */
    public function index(array $data): array
    {
        $response = $this->transport->get('svc/books/v3/lists/best-sellers/history.json', $data);
        $parsedJson = json_decode($response, true);
        $this->validateResponse($parsedJson);
        return $this->parseResponseAsList($parsedJson, Book::class);
    }
}
