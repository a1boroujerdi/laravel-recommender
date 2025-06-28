<?php

return [
    /*
    |--------------------------------------------------------------------------
    | User Model
    |--------------------------------------------------------------------------
    |
    | This is the model class for the users that will be tracked and
    | recommended to. You may change this if your User model is in
    | a different namespace.
    |
    */
    'user_model' => 'App\\Models\\User',

    /*
    |--------------------------------------------------------------------------
    | Product Model
    |--------------------------------------------------------------------------
    |
    | This is the model class for the products that will be recommended.
    | You may change this if your Product model is in a different namespace.
    |
    */
    'product_model' => 'App\\Models\\Product',

    /*
    |--------------------------------------------------------------------------
    | AI Service Configuration
    |--------------------------------------------------------------------------
    |
    | Configure the connection to the AI recommendation service.
    |
    */
    'ai_service_url' => env('ECOMAI_SERVICE_URL', 'https://api.youraiservice.com'),
    'ai_service_api_key' => env('ECOMAI_API_KEY', ''),
    'ai_service_timeout' => env('ECOMAI_TIMEOUT', 5),

    /*
    |--------------------------------------------------------------------------
    | Track Guest Users
    |--------------------------------------------------------------------------
    |
    | Determine whether to track user behaviors for guests (non-authenticated users).
    | If enabled, the package will use session IDs to track guest behaviors.
    |
    */
    'track_guest_users' => env('ECOMAI_TRACK_GUESTS', true),

    /*
    |--------------------------------------------------------------------------
    | Route Configuration
    |--------------------------------------------------------------------------
    |
    | Configure the route middleware and prefix for the API endpoints.
    |
    */
    'middleware' => ['web', 'api'],
    'route_prefix' => 'api/ecomai',

    /*
    |--------------------------------------------------------------------------
    | Recommendation Settings
    |--------------------------------------------------------------------------
    |
    | Configure how recommendations are generated.
    |
    */
    'default_recommendation_limit' => 5,
    'recommendation_cache_time' => 60, // minutes

    /*
    |--------------------------------------------------------------------------
    | Trackable Actions
    |--------------------------------------------------------------------------
    |
    | Define the actions that can be tracked. You can add custom actions
    | specific to your e-commerce platform here.
    |
    */
    'trackable_actions' => [
        'view',      // User viewed a product
        'click',     // User clicked on a product
        'search',    // User searched for a product
        'cart',      // User added product to cart
        'wishlist',  // User added product to wishlist
        'purchase',  // User purchased a product
        'return',    // User returned a product
        'review',    // User reviewed a product
    ],

    /*
    |--------------------------------------------------------------------------
    | Analytics Settings
    |--------------------------------------------------------------------------
    |
    | Configure analytics data collection.
    |
    */
    'analytics_enabled' => true,
    'data_retention_days' => 365, // How long to keep behavior data
]; 