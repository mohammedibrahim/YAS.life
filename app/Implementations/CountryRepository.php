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

use YASLife\Contracts\APIsContract;
use YASLife\Contracts\RepositoryContract;

/**
 * CountryRepository
 *
 * Class Repository
 * @package YASLife\Implementations
 */
class CountryRepository implements RepositoryContract
{
    /**
     * APIs class.
     *
     * @var APIsContract
     */
    protected $apis;

    /**
     * CountryRepository constructor.
     *
     * @param APIsContract $apis
     */
    public function __construct(APIsContract $apis)
    {
        $this->apis = $apis;
    }

    /**
     * Get Country code by country name.
     *
     * @param string $countryName
     * @return string
     * @throws \Exception
     */
    public function getCountryCode(string $countryName): string
    {
        $country = $this->apis->getCountry($countryName);

        if (empty($country[0]['languages'][0]['iso639_1'])) {
            throw new \Exception(sprintf('%s country not found!', $countryName));
        }

        return $country[0]['languages'][0]['iso639_1'];
    }

    /**
     * Get Countries that speak the same language.
     *
     * @param string $countryCode
     * @param string $countryName
     * @return array
     */
    public function getCountriesSpeakingSameLanguage(string $countryCode, string $countryName)
    {
        $otherCountries = $this->apis->countriesSpeakLanguage($countryCode);

        $countries = [];

        foreach ($otherCountries as $otherCountry) {

            if ($otherCountry['name'] === $countryName) {
                continue;
            }

            $countries[] = $otherCountry['name'];
        }

        return $countries;
    }

}