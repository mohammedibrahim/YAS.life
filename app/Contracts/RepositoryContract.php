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
 * Repository Contract
 *
 * Class RepositoryContract
 * @package YASLife\Contracts
 */
interface RepositoryContract
{
    /**
     * getByName.
     *
     * @param string $countryName
     * @return string
     */
    public function getCountryCode(string $countryName): string;

    /**
     * Get Countries that speak the same language.
     *
     * @param string $countryCode
     * @param string $countryName
     * @return array
     */
    public function getCountriesSpeakingSameLanguage(string $countryCode, string $countryName);
}