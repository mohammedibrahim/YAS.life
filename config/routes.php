<?php
/**
 * YAS.Life.
 *
 * @package     YAS.Life.
 * @author      Mohamed Ibrahim <m@mibrah.im>
 * @version     v.1.0 (04/12/2018)
 * @copyright   Copyright (c) 2018
 */

use YASLife\Contracts\RequestContract;
use YASLife\Contracts\ServiceContract;

/**
 * 1,2 Refers to the number of countries sent in the command line
 *
 * If number of parameters is 1 so handle the request by the service getCountryName.
 * If number of parameters is 2 so handle the request by the service checkTalkingLanguage.
 */

return [
    1 => function (ServiceContract $service, RequestContract $request) {
        return $service->getCountryName($request);
    },
    2 => function (ServiceContract $service, RequestContract $request) {
        return $service->checkTalkingLanguage($request);
    },
];