<?php

namespace App\NytApi\Transport;

interface TransportInterface
{
    public function get(string $url, array $data): string;
}
