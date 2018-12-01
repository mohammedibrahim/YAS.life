<?php
/**
 * YAS.life.
 *
 * @package     YAS.life.
 * @author      Mohamed Ibrahim <m@mibrah.im>
 * @version     v.1.0 (30/11/2018)
 * @copyright   Copyright (c) 2018
 */

namespace YASLife\Implementations;

use YASLife\Contracts\ResponseContract;

/**
 * Country Response
 *
 * Class CountryResponse
 * @package YASLife\Implementations
 */
class CountryResponse implements ResponseContract
{
    /**
     * data.
     *
     * @var array
     */
    private $data;

    /**
     * Get request data.
     *
     * @return mixed
     */
    public function get(): string
    {
        return implode("\n", $this->data) . "\n";
    }

    /**
     * Create.
     *
     * @param array $data
     */
    public function create(array $data): void
    {
        $this->data = $data;
    }

}