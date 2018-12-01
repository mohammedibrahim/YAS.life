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
use YASLife\Contracts\ValidationContract;

/**
 * Country Service
 *
 * Class CountryService
 * @package YASLife\Implementations
 */
class CountryService implements ServiceContract
{
    /**
     * Request.
     *
     * @var RequestContract
     */
    protected $request;

    /**
     * Repository.
     *
     * @var RepositoryContract
     */
    protected $repository;

    /**
     * Response.
     *
     * @var ResponseContract
     */
    protected $response;

    /**
     * validation.
     *
     * @var ValidationContract
     */
    protected $validation;

    /**
     * CountryService constructor.
     *
     * @param RequestContract $request
     * @param RepositoryContract $repository
     * @param ResponseContract $response
     */
    public function __construct(RequestContract $request, RepositoryContract $repository, ResponseContract $response)
    {
        $this->request = $request;
        $this->repository = $repository;
        $this->response = $response;
    }

    /**
     * Get Country Name.
     *
     * @return ResponseContract
     */
    public function getCountryName(): ResponseContract
    {
        $request = $this->request->get();

        $country = $this->repository->getByName($request[1]);

        $this->response->create([
            'country_code' => 'Country language code: ' . $country['code'],
            'countries' => $country['country'] . ' speaks same language with these countries: ' . implode(', ', $country['countries'])
        ]);

        return $this->response;
    }

    /**
     * Get Request, handle request.
     *
     * @return mixed
     */
    public function checkTakingLanguage(): ResponseContract
    {
        $request = $this->request->get();

        $firstCountry = $this->repository->getByName($request[1]);

        $secondCountry = $this->repository->getByName($request[2]);

        $this->response->create([
            sprintf('%s and %s %s the same language.', $firstCountry['country'], $secondCountry['country'], $firstCountry['code'] !== $secondCountry['code'] ? 'do not speak' : 'speak')
        ]);

        return $this->response;
    }

}