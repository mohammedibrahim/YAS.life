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
use YASLife\Contracts\CountryAPIsContract;
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
     * APIs.
     *
     * @var APIsContract
     */
    protected $APIs;

    /**
     * CountryRepository constructor.
     *
     * @param CountryAPIsContract $apis
     */
    public function __construct(CountryAPIsContract $apis)
    {
        $this->APIs = $apis;
    }

    /**
     * getByName.
     *
     * @param string $countryName
     * @return array
     */
    public function getByName(string $countryName): array
    {
        $country = $this->APIs->getCountry($countryName);

        $countryCode = @$country[0]['languages'][0]['iso639_1'];

        $otherCountries = $this->APIs->countriesSpeakLanguage($countryCode);

        $countries = [];

        foreach ($otherCountries as $otherCountry) {

            if ($otherCountry['name'] === $countryName) {
                continue;
            }

            $countries[] = $otherCountry['name'];
        }

        return [
            'country' => $countryName,
            'code' => $countryCode,
            'countries' => $countries
        ];
    }

}