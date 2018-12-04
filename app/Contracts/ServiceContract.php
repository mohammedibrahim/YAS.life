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
 * Service Contract
 *
 * Class ServiceContract
 * @package YASLife\Contracts
 */
interface ServiceContract
{
    /**
     * Call Repository and get data using country name.
     *
     * @param RequestContract $request
     * @return ResponseContract
     */
    public function getCountryName(RequestContract $request): ResponseContract;

    /**
     * Check if the given two countries spoke the same languages or not.
     *
     * @param RequestContract $request
     * @return ResponseContract
     */
    public function checkTalkingLanguage(RequestContract $request): ResponseContract;
}