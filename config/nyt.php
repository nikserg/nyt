<?php

return [
    'apiKey' => env('NYT_API_KEY'),
    'host' => env('NYT_API_HOST', 'https://api.nytimes.com/'),
    'cacheTTL' => env('NYT_CACHE_TTL', 60), //in seconds
];
