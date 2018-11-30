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
 * County APIs Test
 *
 * Class CountryAPITest
 * @package YASLife\Contracts
 */
interface CountryAPIsContract extends APIsContract
{
    /**
     * Get Country.
     *
     * @param string $countryName
     * @return array
     */
    public function getCountry(string $countryName): array;

    /**
     * countriesSpeakLanguage.
     * @param string $languageCode
     * @return array
     */
    public function countriesSpeakLanguage(string $languageCode): array;
}