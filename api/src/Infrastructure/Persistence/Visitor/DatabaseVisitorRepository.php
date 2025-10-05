<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Visitor;

use App\Domain\Visitor\Visitor;
use App\Domain\Visitor\VisitorNotFoundException;
use App\Domain\Visitor\VisitorRepository;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;

class DatabaseVisitorRepository implements VisitorRepository
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * {@inheritdoc}
     */
    public function findAll(): array
    {
        $sql = 'SELECT * FROM visitors ORDER BY created_at DESC LIMIT 100';
        
        try {
            $result = $this->connection->executeQuery($sql);
            $visitors = [];
            
            while ($row = $result->fetchAssociative()) {
                $visitors[] = $this->hydrateVisitor($row);
            }
            
            return $visitors;
        } catch (Exception $e) {
            throw new \RuntimeException('Database error: ' . $e->getMessage());
        }
    }

    /**
     * {@inheritdoc}
     */
    public function findVisitorOfId(int $id): Visitor
    {
        $sql = 'SELECT * FROM visitors WHERE id = ?';
        
        try {
            $result = $this->connection->executeQuery($sql, [$id]);
            $row = $result->fetchAssociative();
            
            if (!$row) {
                throw new VisitorNotFoundException();
            }
            
            return $this->hydrateVisitor($row);
        } catch (Exception $e) {
            if ($e instanceof VisitorNotFoundException) {
                throw $e;
            }
            throw new \RuntimeException('Database error: ' . $e->getMessage());
        }
    }

    /**
     * {@inheritdoc}
     */
    public function save(Visitor $visitor): Visitor
    {
        $sql = '
            INSERT INTO visitors (ip_address, user_agent, page, action, data, viewport_width, is_mobile, created_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ';
        
        try {
            $this->connection->executeStatement($sql, [
                $visitor->getIpAddress(),
                $visitor->getUserAgent(),
                $visitor->getPage(),
                $visitor->getAction(),
                $visitor->getData(),
                $visitor->getViewportWidth(),
                $visitor->isMobile() ? 1 : 0,
                $visitor->getCreatedAt()
            ]);
            
            $id = (int) $this->connection->lastInsertId();
            
            return new Visitor(
                $id,
                $visitor->getIpAddress(),
                $visitor->getUserAgent(),
                $visitor->getPage(),
                $visitor->getAction(),
                $visitor->getData(),
                $visitor->getViewportWidth(),
                $visitor->isMobile(),
                $visitor->getCreatedAt()
            );
        } catch (Exception $e) {
            throw new \RuntimeException('Database error: ' . $e->getMessage());
        }
    }

    private function hydrateVisitor(array $row): Visitor
    {
        return new Visitor(
            (int) $row['id'],
            $row['ip_address'],
            $row['user_agent'],
            $row['page'],
            $row['action'],
            $row['data'],
            (int) $row['viewport_width'],
            (bool) $row['is_mobile'],
            $row['created_at']
        );
    }
}