<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

class BestsellersController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'List of users',
            'data' => [
                ['name' => 'John Doe'],
                ['name' => 'Jane Doe'],
            ],
        ]);
    }
}
