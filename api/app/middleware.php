<?php

declare(strict_types=1);

use Slim\App;
use Slim\Middleware\ErrorMiddleware;

return function (App $app) {
    // CORS Middleware
    $app->add(function ($request, $handler) {
        $response = $handler->handle($request);
        
        $origin = $_ENV['CORS_ORIGIN'] ?? '*';
        
        return $response
            ->withHeader('Access-Control-Allow-Origin', $origin)
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS')
            ->withHeader('Access-Control-Allow-Credentials', 'true');
    });

    // Handle OPTIONS requests
    $app->options('/{routes:.+}', function ($request, $response, $args) {
        return $response;
    });
};