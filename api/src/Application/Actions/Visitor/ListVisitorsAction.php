<?php

declare(strict_types=1);

namespace App\Application\Actions\Visitor;

use Psr\Http\Message\ResponseInterface as Response;

class ListVisitorsAction extends VisitorAction
{
    protected function action(): Response
    {
        $visitors = $this->visitorRepository->findAll();

        $this->logger->info('Visitors list was viewed');

        return $this->respondWithData($visitors);
    }
}