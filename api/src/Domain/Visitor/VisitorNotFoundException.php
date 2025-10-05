<?php

declare(strict_types=1);

namespace App\Domain\Visitor;

use App\Domain\DomainException\DomainNotFoundException;

class VisitorNotFoundException extends DomainNotFoundException
{
    public $message = 'The visitor you requested does not exist.';
}