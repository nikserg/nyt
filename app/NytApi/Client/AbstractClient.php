<?php

namespace App\NytApi\Client;

use App\NytApi\Exceptions\FailResponseException;
use App\NytApi\Transport\TransportInterface;

class AbstractClient
{
    public function __construct(protected TransportInterface $transport)
    {
    }

    protected function validateResponse(array $parsedJson): void
    {
        if (!(isset($parsedJson['status']) && $parsedJson['status'] === 'OK')) {
            throw new FailResponseException('Response status is not OK: ' . json_encode($parsedJson));
        }
    }

    protected function parseResponseAsList(array $parsedJson, string $dtoClassName): array
    {
        $results = $parsedJson['results'];
        $dtoObjects = [];
        foreach ($results as $result) {
            $dtoObjects[] = new $dtoClassName($result);
        }
        return $dtoObjects;
    }
}
