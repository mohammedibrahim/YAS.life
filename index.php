<?php
/**
 * Load Vendor.
 */
require_once __DIR__ . '/vendor/autoload.php';

/**
 * Load Config file.
 */
$config = require_once __DIR__ . '/config/app.php';

/**
 * Routes
 */
$serviceMapper = require_once  __DIR__  . '/config/routes.php';

/**
 * Load IOC.
 */
$container = new \Illuminate\Container\Container();

/**
 * Bind Classes
 */
foreach ((array)$config['bindings'] as $contract => $abstract) {
    $container->bind($contract, $abstract);
}

/**
 * Load Main Service.
 */
$command = $container->makeWith(\YASLife\Contracts\RouteContract::class, [
    'serviceMapper' => $serviceMapper
]);

$container->call([$command, 'print'], ['data' => $argv]);