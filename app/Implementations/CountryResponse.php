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
     * CountryResponse constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Get request data.
     *
     * @return mixed
     */
    public function get(): string
    {
        return sprintf("%s\n", implode("\n", $this->data));
    }
}