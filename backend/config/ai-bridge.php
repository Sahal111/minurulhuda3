<?php

return [

    /*
    |--------------------------------------------------------------------------
    | AI Bridge Configuration
    |--------------------------------------------------------------------------
    |
    | Settings for the FastAPI Context Builder sidecar.
    | The Python server must be running for the bridge to work.
    |
    | Start the sidecar:
    |   cd ai_tools && source venv/bin/activate
    |   uvicorn api.main:app --host 127.0.0.1 --port 8000
    |
    */

    // Base URL of the FastAPI server
    'base_url' => env('AI_BRIDGE_URL', 'http://127.0.0.1:8000'),

    // Maximum seconds to wait for a response (includes embedding time on first call)
    'timeout' => (int) env('AI_BRIDGE_TIMEOUT', 30),

    // Maximum seconds to wait for TCP connection
    'connect_timeout' => (int) env('AI_BRIDGE_CONNECT_TIMEOUT', 5),

    // Number of retry attempts on connection failure or 5xx
    'retries' => (int) env('AI_BRIDGE_RETRIES', 2),

    // Milliseconds to wait between retries
    'retry_delay' => (int) env('AI_BRIDGE_RETRY_DELAY', 200),

    // Optional response caching
    'cache' => [
        'enabled' => (bool) env('AI_BRIDGE_CACHE_ENABLED', false),
        'ttl'     => (int) env('AI_BRIDGE_CACHE_TTL', 300), // seconds
    ],

];
