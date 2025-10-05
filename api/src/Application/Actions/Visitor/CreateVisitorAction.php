<?php

declare(strict_types=1);

namespace App\Application\Actions\Visitor;

use App\Domain\Visitor\Visitor;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class CreateVisitorAction extends VisitorAction
{
    protected function action(): Response
    {
        $data = $this->getFormData();
        
        // Validate required fields
        if (!isset($data['action']) || !isset($data['page'])) {
            throw new HttpBadRequestException($this->request, 'Missing required fields: action, page');
        }

        // Get client information
        $ipAddress = $this->getClientIpAddress();
        $userAgent = $this->request->getHeaderLine('User-Agent') ?: 'Unknown';
        
        // Extract data from request
        $page = $data['page'];
        $action = $data['action'];
        $actionData = isset($data['data']) ? json_encode($data['data']) : null;
        $viewportWidth = (int) ($data['viewportWidth'] ?? 0);
        $isMobile = (bool) ($data['isMobile'] ?? false);

        // Create visitor record
        $visitor = new Visitor(
            null, // ID will be auto-generated
            $ipAddress,
            $userAgent,
            $page,
            $action,
            $actionData,
            $viewportWidth,
            $isMobile
        );

        // Save to database
        $savedVisitor = $this->visitorRepository->save($visitor);

        $this->logger->info('Visitor action recorded', [
            'id' => $savedVisitor->getId(),
            'action' => $action,
            'page' => $page,
            'ip' => $ipAddress
        ]);

        return $this->respondWithData($savedVisitor, 201);
    }

    private function getClientIpAddress(): string
    {
        $serverParams = $this->request->getServerParams();
        
        // Check for IP in various headers (for proxies/load balancers)
        $ipKeys = [
            'HTTP_X_FORWARDED_FOR',
            'HTTP_X_REAL_IP',
            'HTTP_CLIENT_IP',
            'REMOTE_ADDR'
        ];

        foreach ($ipKeys as $key) {
            if (!empty($serverParams[$key])) {
                $ip = trim(explode(',', $serverParams[$key])[0]);
                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
                    return $ip;
                }
            }
        }

        return $serverParams['REMOTE_ADDR'] ?? '127.0.0.1';
    }
}