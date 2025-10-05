<?php

declare(strict_types=1);

namespace App\Application\Actions\Visitor;

use Psr\Http\Message\ResponseInterface as Response;

class ViewVisitorAction extends VisitorAction
{
    protected function action(): Response
    {
        $visitorId = (int) $this->resolveArg('id');
        $visitor = $this->visitorRepository->findVisitorOfId($visitorId);

        $this->logger->info('Visitor of id `' . $visitorId . '` was viewed');

        return $this->respondWithData($visitor);
    }
}