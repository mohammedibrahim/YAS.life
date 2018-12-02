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

use YASLife\Contracts\ResponseContract;
use YASLife\Contracts\RouteContract;
use YASLife\Contracts\ServiceContract;
use YASLife\Implementations\Factories\CountryRequestFactory;
use YASLife\Implementations\Handlers\ErrorHandler;

/**
 * Route Manager Handler
 *
 * Class Route
 * @package YASLife\Implementations
 */
class CountryRoute implements RouteContract
{
    /**
     * countryServiceMapper.
     *
     * @var array
     */
    protected $countryServiceMapper = [
        1 => 'getCountryName',
        2 => 'checkTakingLanguage'
    ];


    /**
     * Print country information.
     *
     * @param ServiceContract $service
     * @param ErrorHandler $errorHandler
     * @param array $data
     * @return void
     */
    public function print(ServiceContract $service, ErrorHandler $errorHandler, array $data): void
    {
        try {
            echo $this->serve($service, $data)->get();
        } catch (\Exception $e) {
            echo $errorHandler->getErrorMessage($e);
        }
    }

    /**
     * Get Request data from browser and route it to the right service method..
     *
     * @param ServiceContract $service
     * @param array $data
     * @return ResponseContract
     * @throws \Exception
     */
    public function serve(ServiceContract $service, array $data): ResponseContract
    {
        unset($data[0]);

        if (empty($this->countryServiceMapper[sizeof($data)])) {
            throw new \Exception('Your command syntax must follow this schema "php index.php [string country_name] [OPTIONAL string second_country_name]"');
        }

        $method = $this->countryServiceMapper[sizeof($data)];

        return $service->$method(CountryRequestFactory::create($data));
    }

}