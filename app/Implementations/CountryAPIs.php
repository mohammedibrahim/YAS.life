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

use GuzzleHttp\Client;
use YASLife\Contracts\APIsContract;

/**
 * Country APIs
 *
 * Class CountryAPIs
 * @package YASLife\Implementations
 */
class CountryAPIs implements APIsContract
{
    /**
     * guzzleClient.
     *
     * @var Client
     */
    private $guzzleClient;

    /**
     * CountryAPIs constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->guzzleClient = $client;
    }

    /**
     * Get Country information by country name.
     *
     * @param string $countryName
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCountry(string $countryName): array
    {
        $response = $this->guzzleClient->request('GET', sprintf('name/%s?fullText=true', $countryName));

        $country = json_decode($response->getBody(), 1);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception(sprintf('%s country not found!', $countryName));
        }

        return $country;
    }

    /**
     * Get List of countries that speaks the same language with the given country code.
     *
     * @param string $languageCode
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function countriesSpeakLanguage(string $languageCode): array
    {
        $response = $this->guzzleClient->request('GET', sprintf('lang/%s', $languageCode));

        $countries = json_decode($response->getBody(), 1);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception(sprintf('Language code %s not found!', $languageCode));
        }

        return $countries;
    }
}