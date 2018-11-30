<?php

use YASLife\Contracts\CommandContract;
use YASLife\Contracts\CountryAPIsContract;
use YASLife\Contracts\RepositoryContract;
use YASLife\Contracts\RequestContract;
use YASLife\Contracts\ResponseContract;
use YASLife\Contracts\ServiceContract;
use YASLife\Implementations\CountryAPIs;
use YASLife\Implementations\CountryCommand;
use YASLife\Implementations\CountryRepository;
use YASLife\Implementations\CountryRequest;
use YASLife\Implementations\CountryResponse;
use YASLife\Implementations\CountryService;

return [
    'bindings' => [
        CommandContract::class => CountryCommand::class,
        ServiceContract::class => CountryService::class,
        ResponseContract::class => CountryResponse::class,
        RepositoryContract::class => CountryRepository::class,
        CountryAPIsContract::class => CountryAPIs::class,
        RequestContract::class => function ($app) use ($argv) {

            unset($argv[0]);

            $request = $app->makeWith(CountryRequest::class, [
                'data' => $argv,
            ]);

            return $request;
        }
    ],
];