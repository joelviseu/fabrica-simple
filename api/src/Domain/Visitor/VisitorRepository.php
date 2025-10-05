<?php

declare(strict_types=1);

namespace App\Domain\Visitor;

interface VisitorRepository
{
    /**
     * @return Visitor[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return Visitor
     * @throws VisitorNotFoundException
     */
    public function findVisitorOfId(int $id): Visitor;

    /**
     * @param Visitor $visitor
     * @return Visitor
     */
    public function save(Visitor $visitor): Visitor;
}