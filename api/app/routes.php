<?php

declare(strict_types=1);

use App\Application\Actions\Visitor\CreateVisitorAction;
use App\Application\Actions\Visitor\ListVisitorsAction;
use App\Application\Actions\Visitor\ViewVisitorAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write(json_encode([
            'message' => 'HomeStyle Furniture API',
            'version' => '1.0.0',
            'endpoints' => [
                'POST /api/visitors' => 'Create a new visitor record',
                'GET /api/visitors' => 'List all visitors',
                'GET /api/visitors/{id}' => 'Get specific visitor'
            ]
        ]));
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->group('/api', function (Group $group) {
        $group->group('/visitors', function (Group $group) {
            $group->post('', CreateVisitorAction::class);
            $group->get('', ListVisitorsAction::class);
            $group->get('/{id}', ViewVisitorAction::class);
        });
    });
};