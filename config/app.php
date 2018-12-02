<?php

use GuzzleHttp\Client;
use YASLife\Contracts\APIsContract;
use YASLife\Contracts\RouteContract;
use YASLife\Contracts\RepositoryContract;
use YASLife\Contracts\ServiceContract;
use YASLife\Implementations\CountryAPIs;
use YASLife\Implementations\CountryRoute;
use YASLife\Implementations\CountryRepository;
use YASLife\Implementations\CountryService;

$apisConfig = require_once __DIR__ . '/apis.php';

return [
    'bindings' => [
        RouteContract::class => CountryRoute::class,
        ServiceContract::class => CountryService::class,
        RepositoryContract::class => CountryRepository::class,
        APIsContract::class => function ($app) use ($apisConfig) {

            $api = $app->makeWith(CountryAPIs::class, [
                'client' => $app->makeWith(Client::class, ['config' => ['base_uri' => $apisConfig['apis']['base_url']]])
            ]);

            return $api;
        }
    ],
];