<?php

declare(strict_types=1);

namespace App\Application\ResponseEmitter;

use Psr\Http\Message\ResponseInterface;
use Slim\ResponseEmitter as SlimResponseEmitter;

class ResponseEmitter extends SlimResponseEmitter
{
    public function emit(ResponseInterface $response): void
    {
        // This method is intentionally empty so that it does not emit the response
        // The parent implementation would use echo and headers() functions
        if (!headers_sent()) {
            parent::emit($response);
        }
    }
}