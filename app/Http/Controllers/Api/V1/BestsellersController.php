<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\BestsellersIndexRequest;
use App\NytApi\Client\BestsellersClient;

class BestsellersController extends Controller
{
    public function __construct(private BestsellersClient $client)
    {
    }

    public function index(BestsellersIndexRequest $request): array
    {
        return $this->client->index($request->validated());
    }
}
