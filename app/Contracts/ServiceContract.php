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
     * Get Country Name.
     *
     * @return ResponseContract
     */
    public function getCountryName(): ResponseContract;

    /**
     * Get Request, handle request.
     *
     * @return mixed
     */
    public function checkTakingLanguage(): ResponseContract;
}