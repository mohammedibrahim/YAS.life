<?php
/**
 * YAS.Life.
 *
 * @package     YAS.Life.
 * @author      Mohamed Ibrahim <m@mibrah.im>
 * @version     v.1.0 (30/11/2018)
 * @copyright   Copyright (c) 2018
 */

namespace YASLife\Contracts;

/**
 * Command Contract
 *
 * Class CommandContract
 * @package YASLife\Contracts
 */
interface CommandContract
{
    /**
     * Handle.
     *
     * @param RequestContract $request
     * @param ServiceContract $service
     * @return string
     */
    public function handle(RequestContract $request, ServiceContract $service);

    /**
     * Serve.
     *
     * @param RequestContract $request
     * @param ServiceContract $service
     * @return ResponseContract
     */
    public function serve(RequestContract $request, ServiceContract $service): ResponseContract;
}