<?php

use GuzzleHttp\Client;

return [
    'app_url' => env('WORDPRESS_APP_URL', 'https://localhost'),
    'client' => new Client([
        'base_uri' => env('WORDPRESS_APP_URL', 'https://localhost'),
        'timeout' => 60.0,
        'headers' => [
            'User-Agent' => 'Made I.T. - WordPress PHP SDK',
            'Accept' => 'application/json',
        ],
        'verify' => true,
    ]),
];
