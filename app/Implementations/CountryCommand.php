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

use YASLife\Contracts\CommandContract;
use YASLife\Contracts\RequestContract;
use YASLife\Contracts\ResponseContract;
use YASLife\Contracts\ServiceContract;

/**
 * Command Manager Handler
 *
 * Class Command
 * @package YASLife\Implementations
 */
class CountryCommand implements CommandContract
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
     * Handle.
     *
     * @param RequestContract $request
     * @param ServiceContract $service
     * @return string|void
     */
    public function handle(RequestContract $request, ServiceContract $service)
    {
        try {
            echo $this->serve($request, $service)->get();
        } catch (\Exception $e) {
            echo 'Error: ' . $e->getMessage() . "\n";
        }
    }

    /**
     * Serve.
     *
     * @param RequestContract $request
     * @param ServiceContract $service
     * @return ResponseContract
     * @throws \Exception
     */
    public function serve(RequestContract $request, ServiceContract $service): ResponseContract
    {
        $data = $request->get();

        if (empty($this->countryServiceMapper[sizeof($data)])) {
            throw new \Exception('Your command syntax must follow this schema "php index.php [string country_name] [OPTIONAL string second_country_name]"');
        }

        $method = $this->countryServiceMapper[sizeof($data)];

        return $service->$method();
    }

}