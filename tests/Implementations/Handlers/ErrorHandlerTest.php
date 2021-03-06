<?php
/**
 * YAS.life.
 *
 * @package     YAS.life.
 * @author      Mohamed Ibrahim <m@mibrah.im>
 * @version     v.1.0 (30/11/2018)
 * @copyright   Copyright (c) 2018
 */

namespace YASLifeTest\Implementations\Factories;

use YASLife\Implementations\Handlers\ErrorHandler;
use YASLifeTest\UnitTest;

/**
 * Error Handler Test
 *
 * Class CountryAPIs
 * @package YASLife\Implementations
 */
class ErrorHandlerTest extends UnitTest
{
    /**
     * errorHandler.
     *
     * @var ErrorHandler
     */
    protected $errorHandler;

    public function setUp()
    {
        $this->errorHandler = new ErrorHandler();
    }

    /**
     * Test get error message.
     *
     */
    public function testGetErrorMessage()
    {
        $errorMessage = 'Custom error message';

        $error = new \Exception($errorMessage);
        $error = $this->errorHandler->getErrorMessage($error);
        $this->assertEquals(sprintf('%s%s',$errorMessage, PHP_EOL,PHP_EOL), $error);
    }
}