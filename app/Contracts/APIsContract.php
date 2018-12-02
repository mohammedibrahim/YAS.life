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
 * APIs Contract
 *
 * Class APIsContract
 * @package YASLife\Contracts
 */
interface APIsContract
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