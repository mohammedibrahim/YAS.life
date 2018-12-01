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

/**
 * Request Contract
 *
 * Class RequestContract
 * @package YASLife\Contracts
 */
interface ResponseContract
{
    /**
     * Get request data.
     *
     * @return mixed
     */
    public function get(): string;

    /**
     * Create.
     *
     * @param array $data
     */
    public function create(array $data): void;
}