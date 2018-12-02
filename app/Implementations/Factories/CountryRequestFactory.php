<?php
/**
 * YAS.life.
 *
 * @package     YAS.life.
 * @author      Mohamed Ibrahim <m@mibrah.im>
 * @version     v.1.0 (02/12/2018)
 * @copyright   Copyright (c) 2018
 */

namespace YASLife\Implementations\Factories;

use YASLife\Contracts\RequestContract;
use YASLife\Implementations\CountryRequest;

/**
 * Country Request Factory
 *
 * Class CountryRequestFactory
 * @package YASLife\Implementations\Factories
 */
class CountryRequestFactory
{
    /**
     * Generate and immutable instance of request.
     *
     * @param array $data
     * @return RequestContract
     */
    public static function create(array $data): RequestContract
    {
        return new CountryRequest($data);
    }
}