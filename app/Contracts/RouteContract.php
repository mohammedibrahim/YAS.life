<?php
/**
 * YAS.life.
 *
 * @package     YAS.life.
 * @author      Mohamed Ibrahim <m@mibrah.im>
 * @version     v.1.0 (30/11/2018)
 * @copyright   Copyright (c) 2018
 */

namespace YASLife\Contracts;

use YASLife\Implementations\Handlers\ErrorHandler;

/**
 * Route Contract
 *
 * Class RouteContract
 * @package YASLife\Contracts
 */
interface RouteContract
{
    /**
     * Print country information.
     *
     * @param ServiceContract $service
     * @param ErrorHandler $errorHandler
     * @param array $data
     * @return void
     */
    public function print(ServiceContract $service, ErrorHandler $errorHandler, array $data): void;

    /**
     * Get Request data from browser and route it to the right service method.
     *
     * @param ServiceContract $service
     * @param array $data
     * @return ResponseContract
     */
    public function serve(ServiceContract $service, array $data): ResponseContract;
}