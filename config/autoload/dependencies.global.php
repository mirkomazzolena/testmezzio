<?php

declare(strict_types=1);

use App\Handler\DatabaseHandler;
use Laminas\Db\Adapter\Adapter;
use Psr\Container\ContainerInterface;
use App\Handler\LogHandler;
use App\Handler\CalcolaHandler;

return [
    // Provides application-wide services.
    // We recommend using fully-qualified class names whenever possible as
    // service names.
    'dependencies' => [
        // Use 'aliases' to alias a service name to another service. The
        // key is the alias name, the value is the service to which it points.
        'aliases' => [
            // Fully\Qualified\ClassOrInterfaceName::class => Fully\Qualified\ClassName::class,
        ],
        // Use 'invokables' for constructor-less services, or services that do
        // not require arguments to the constructor. Map a service name to the
        // class name.
        'invokables' => [
            // Fully\Qualified\InterfaceName::class => Fully\Qualified\ClassName::class,
        ],
        // Use 'factories' for services provided by callbacks/factory classes.
        'factories' => [
            LogHandler::class => function (ContainerInterface $container) {
                $db = $container->get(Adapter::class);
                return new LogHandler($db);
            },
            CalcolaHandler::class => function (ContainerInterface $container) {
                $db = $container->get(Adapter::class);
                return new CalcolaHandler($db);
            },
        ],
    ],
];
