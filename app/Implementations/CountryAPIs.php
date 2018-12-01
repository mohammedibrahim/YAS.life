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

use YASLife\Contracts\CountryAPIsContract;

/**
 * Country APIs
 *
 * Class CountryAPIs
 * @package YASLife\Implementations
 */
class CountryAPIs implements CountryAPIsContract
{
    /**
     * Base API Url.
     */
    const BASE_URL = 'https://restcountries.eu/rest/v2/';

    /**
     * apiUrl.
     *
     * @var
     */
    private $apiUrl;

    /**
     * Get.
     *
     * @param string $countryName
     * @return array
     * @throws \Exception
     */
    public function getCountry(string $countryName): array
    {
        $this->apiUrl = self::BASE_URL . 'name/' . $countryName . '?fullText=true';

        $country = $this->request();

        if (empty($country)) {
            throw new \Exception($countryName . ' country not found!');
        }

        $country = json_decode($country, 1);

        return $country;
    }

    /**
     * Request.
     *
     * @return array
     * @throws \Exception
     */
    public function request()
    {
        return @file_get_contents($this->apiUrl);
    }

    /**
     * countriesSpeakLanguage.
     * @param string $languageCode
     * @return array
     * @throws \Exception
     */
    public function countriesSpeakLanguage(string $languageCode): array
    {
        $this->apiUrl = self::BASE_URL . 'lang/' . $languageCode;

        $countries = $this->request();

        if (empty($countries)) {
            throw new \Exception('Something went wrong');
        }

        $countries = json_decode($countries, 1);

        return $countries;
    }


}