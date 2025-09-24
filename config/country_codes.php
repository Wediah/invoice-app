<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Country Codes Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains the configuration for country codes used throughout
    | the application. The data is cached for performance optimization.
    |
    */

    'cache_duration' => env('COUNTRY_CODES_CACHE_DURATION', 60 * 24), // 24 hours in minutes

    'popular_countries' => [
        'GH', 'US', 'GB', 'NG', 'KE', 'ZA', 'IN', 'CA', 'AU', 'DE', 
        'FR', 'IT', 'ES', 'BR', 'MX', 'JP', 'CN', 'KR'
    ],

    'default_country' => 'GH',

    'default_phone_code' => '+233',
];
