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

use YASLife\Contracts\RepositoryContract;
use YASLife\Contracts\RequestContract;
use YASLife\Contracts\ResponseContract;
use YASLife\Contracts\ServiceContract;
use YASLife\Implementations\Factories\CountryResponseFactory;

/**
 * Country Service
 *
 * Class CountryService
 * @package YASLife\Implementations
 */
class CountryService implements ServiceContract
{
    /**
     * Repository.
     *
     * @var RepositoryContract
     */
    protected $repository;

    /**
     * CountryService constructor.
     * @param RepositoryContract $repository
     */
    public function __construct(RepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Call Repository and get data using country name.
     *
     * @param RequestContract $request
     * @return ResponseContract
     */
    public function getCountryName(RequestContract $request): ResponseContract
    {
        $countryName = $request->get()[1];

        $countryCode = $this->repository->getCountryCode($countryName);

        $countries = $this->repository->getCountriesSpeakingSameLanguage($countryCode, $countryName);

        return CountryResponseFactory::create([
            'country_code' => sprintf('Country language code: %s', $countryCode),
            'countries' => sprintf('%s speaks same language with these countries: %s', $countryName, implode(', ', $countries))
        ]);
    }

    /**
     * Check if the given two countries spoke the same languages or not.
     *
     * @param RequestContract $request
     * @return ResponseContract
     */
    public function checkTalkingLanguage(RequestContract $request): ResponseContract
    {
        $firstCountryName = $request->get()[1];
        $secondCountryName = $request->get()[2];

        $firstCountryCode = $this->repository->getCountryCode($firstCountryName);

        $secondCountryCode = $this->repository->getCountryCode($secondCountryName);

        return CountryResponseFactory::create([
            sprintf('%s and %s %s the same language.',
                $firstCountryName, $secondCountryName,
                $firstCountryCode !== $secondCountryCode ? 'do not speak' : 'speak')
        ]);
    }

}