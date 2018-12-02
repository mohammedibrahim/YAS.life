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

use YASLife\Contracts\ResponseContract;
use YASLife\Implementations\CountryResponse;

/**
 * Country Response Factory
 *
 * Class CountryResponseFactory
 * @package YASLife\Implementations\Factories
 */
class CountryResponseFactory
{
    /**
     * Generate and immutable instance of request.
     *
     * @param array $data
     * @return ResponseContract
     */
    public static function create(array $data): ResponseContract
    {
        return new CountryResponse($data);
    }
}