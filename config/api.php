<?php

return [

    /*
    |--------------------------------------------------------------------------
    | API Extra Configurations
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'google_map' => [
        'api_key' => env('GOOGLE_MAP_API_KEY','12345'),
        'cache_limit' => env('GOOGLE_MAP_CACHE_LIMIT', 60*60*24),
    ],



];
