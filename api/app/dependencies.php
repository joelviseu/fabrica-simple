<?php

declare(strict_types=1);

use App\Application\Settings\SettingsInterface;
use App\Domain\Visitor\VisitorRepository;
use App\Infrastructure\Persistence\Visitor\DatabaseVisitorRepository;
use DI\ContainerBuilder;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        LoggerInterface::class => function (ContainerInterface $c) {
            $settings = $c->get(SettingsInterface::class);

            $loggerSettings = $settings->get('logger');
            $logger = new Logger($loggerSettings['name']);

            $processor = new UidProcessor();
            $logger->pushProcessor($processor);

            $handler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
            $logger->pushHandler($handler);

            return $logger;
        },

        Connection::class => function (ContainerInterface $c) {
            $settings = $c->get(SettingsInterface::class);
            $dbSettings = $settings->get('db');

            // Try socket connection for local development
            $connectionParams = [
                'dbname' => $dbSettings['database'],
                'user' => $dbSettings['username'],
                'password' => $dbSettings['password'],
                'host' => $dbSettings['host'],
                'driver' => 'pdo_mysql',
                'charset' => $dbSettings['charset'],
                'unix_socket' => '/var/run/mysqld/mysqld.sock', // For Ubuntu MySQL
            ];

            return DriverManager::getConnection($connectionParams);
        },

        VisitorRepository::class => function (ContainerInterface $c) {
            return new DatabaseVisitorRepository($c->get(Connection::class));
        },
    ]);
};