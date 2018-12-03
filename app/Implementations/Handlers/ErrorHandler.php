<?php
/**
 * YAS.life.
 *
 * @package     YAS.life.
 * @author      Mohamed Ibrahim <m@mibrah.im>
 * @version     v.1.0 (02/12/2018)
 * @copyright   Copyright (c) 2018
 */

namespace YASLife\Implementations\Handlers;

use GuzzleHttp\Exception\ClientException;

/**
 * ErrorHandler
 *
 * Class ErrorHandler
 * @package YASLife\Implementations
 */
class ErrorHandler
{
    /**
     * Switch between different error classes and return error messages.
     *
     * @param \Exception $exception
     * @return string
     */
    public function getErrorMessage(\Exception $exception): string
    {
        switch (get_class($exception)) {

            case ClientException::class:
                $errorMessage = $this->getAPIRequestErrors($exception);
                break;
            case \Exception::class:
            default:
                $errorMessage = $exception->getMessage();
                break;
        }

        return sprintf("%s\n", $errorMessage);
    }

    /**
     * Handle exceptions that comes from Guzzle client.
     *
     * @param ClientException $exception
     * @return string
     */
    protected function getAPIRequestErrors(ClientException $exception): string
    {
        $uri = $exception->getRequest()->getRequestTarget();

        $errorBody = json_decode($exception->getResponse()->getBody(), 1);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $errorMessage = 'Something went wrong please try again later!';
        } else {
            $errorMessage = $errorBody['message'];
        }

        return sprintf('The api response for the uri "%s" is "%s"', $uri, $errorMessage);
    }
}