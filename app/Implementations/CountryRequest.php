<?php
/**
 * YAS.Life.
 *
 * @package     YAS.Life.
 * @author      Mohamed Ibrahim <m@mibrah.im>
 * @version     v.1.0 (30/11/2018)
 * @copyright   Copyright (c) 2018
 */

namespace YASLife\Implementations;

use YASLife\Contracts\RequestContract;

/**
 * Request
 *
 * Class Request
 * @package YASLife\Implementations
 */
class CountryRequest implements RequestContract
{
    /**
     * data.
     *
     * @var array
     */
    private $data;

    /**
     * CountryRequest constructor.
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
    public function get(): array
    {
        return $this->data;
    }
}