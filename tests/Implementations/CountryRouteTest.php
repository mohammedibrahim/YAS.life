<?php
/**
 * YAS.life.
 *
 * @package     YAS.life.
 * @author      Mohamed Ibrahim <m@mibrah.im>
 * @version     v.1.0 (30/11/2018)
 * @copyright   Copyright (c) 2018
 */

namespace YASLifeTest\Implementations;

use YASLife\Contracts\ResponseContract;
use YASLife\Contracts\ServiceContract;
use YASLife\Implementations\CountryCommand;
use YASLife\Implementations\CountryRequest;
use YASLife\Implementations\CountryResponse;
use YASLife\Implementations\CountryRoute;
use YASLife\Implementations\CountryService;
use YASLife\Implementations\Handlers\ErrorHandler;
use YASLifeTest\UnitTest;

/**
 * Command Manager Handler Test
 *
 * Class Command
 * @package YASLife\Implementations
 */
class CountryCommandTest extends UnitTest
{
    /**
     * countryCommand.
     *
     * @var CountryRoute
     */
    protected $countryRoute;

    /**
     * countryRequestMock.
     *
     * @var CountryRequest
     */
    protected $countryRequestMock;

    /**
     * countryServiceMock.
     *
     * @var CountryService
     */
    protected $countryServiceMock;

    /**
     * countryResponseMock.
     *
     * @var CountryResponse
     */
    protected $countryResponseMock;

    /**
     * countryResponseMock.
     *
     * @var CountryResponse
     */
    protected $errorHandlerMock;

    /**
     * setUp.
     */
    public function setUp()
    {
        $this->countryRoute = new CountryRoute();
        $this->countryServiceMock = $this->getMockBuilder(ServiceContract::class)->disableOriginalConstructor()->getMock();
        $this->errorHandlerMock = $this->getMockBuilder(ErrorHandler::class)->getMock();
        $this->countryResponseMock = $this->getMockBuilder(ResponseContract::class)->getMock();
    }

    /**
     * testServe.
     */
    public function testServe()
    {
        $result = $this->countryRoute->serve($this->countryServiceMock, [1 => 'Egypt']);

        $this->assertInstanceOf(ResponseContract::class, $result);
    }

    /**
     * testServeRequestItemsEmpty.
     */
    public function testServeRequestItemsEmpty()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Your command syntax must follow this schema "php index.php [string country_name] [OPTIONAL string second_country_name]"');

        $this->countryRoute->serve($this->countryServiceMock, []);
    }

    /**
     * testServeRequestItemsNotFound.
     */
    public function testServeRequestItemsNotFound()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Your command syntax must follow this schema "php index.php [string country_name] [OPTIONAL string second_country_name]"');

        $this->countryRoute->serve($this->countryServiceMock, ['Egypt', 'Spain', 'Libya', 'Saudi Arabia']);
    }

    /**
     * Test Print method print results.
     */
    public function testPrint()
    {
        $responseText = 'Dummy text for response';
        $this->countryRoute = $this->getMockBuilder(CountryRoute::class)->setMethods(['serve'])->getMock();
        $this->countryResponseMock->method('get')->willReturn($responseText);
        $this->countryRoute->expects($this->once())->method('serve')->willReturn($this->countryResponseMock);

        ob_start();
        $this->countryRoute->print($this->countryServiceMock, $this->errorHandlerMock, ['index.php', 'Egypt']);
        $result = ob_get_contents();
        ob_end_clean();

        $this->assertEquals($responseText, $result);
    }

    /**
     * Test if an exception thrown print method must return "Error [error description]".
     */
    public function testHandleError()
    {
        $exceptionText = 'dummy exception text';
        $this->errorHandlerMock->method('getErrorMessage')->will($this->returnValue('Error: ' . $exceptionText));
        $this->countryRoute = $this->getMockBuilder(CountryRoute::class)->setMethods(['serve'])->getMock();
        $this->countryRoute->expects($this->once())->method('serve')->will($this->throwException(new \Exception($exceptionText)));

        ob_start();
        $this->countryRoute->print($this->countryServiceMock, $this->errorHandlerMock, ['index.php', 'Wrong Country Name']);
        $result = ob_get_contents();
        ob_end_clean();

        $this->assertEquals('Error: ' . $exceptionText, $result);
    }
}