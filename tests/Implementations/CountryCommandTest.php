<?php
/**
 * YAS.Life.
 *
 * @package     YAS.Life.
 * @author      Mohamed Ibrahim <m@mibrah.im>
 * @version     v.1.0 (30/11/2018)
 * @copyright   Copyright (c) 2018
 */

namespace YASLifeTest\Implementations;

use YASLife\Contracts\RequestContract;
use YASLife\Contracts\ResponseContract;
use YASLife\Contracts\ServiceContract;
use YASLife\Implementations\CountryCommand;
use YASLife\Implementations\CountryRequest;
use YASLife\Implementations\CountryResponse;
use YASLife\Implementations\CountryService;
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
     * @var array
     */
    protected $countryCommand;

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
     * setUp.
     */
    public function setUp()
    {
        $this->countryCommand = new CountryCommand();
        $this->countryRequestMock = $this->getMockBuilder(RequestContract::class)->getMock();
        $this->countryServiceMock = $this->getMockBuilder(ServiceContract::class)->disableOriginalConstructor()->getMock();
        $this->countryResponseMock = $this->getMockBuilder(ResponseContract::class)->getMock();
    }

    /**
     * testServe.
     */
    public function testServe()
    {
        $this->countryRequestMock->method('get')->will($this->returnValue([1 => 'Egypt']));

        $result = $this->countryCommand->serve($this->countryRequestMock, $this->countryServiceMock);

        $this->assertInstanceOf(ResponseContract::class, $result);
    }

    /**
     * testServeRequestItemsEmpty.
     */
    public function testServeRequestItemsEmpty()
    {
        $this->countryRequestMock->method('get')->will($this->returnValue([]));

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Your command syntax must follow this schema "php index.php [string country_name] [OPTIONAL string second_country_name]"');

        $result = $this->countryCommand->serve($this->countryRequestMock, $this->countryServiceMock);

        $this->assertInstanceOf(ResponseContract::class, $result);
    }

    /**
     * testServeRequestItemsNotFound.
     */
    public function testServeRequestItemsNotFound()
    {
        $this->countryRequestMock->method('get')->will($this->returnValue([3 => 'Egypt']));

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Your command syntax must follow this schema "php index.php [string country_name] [OPTIONAL string second_country_name]"');

        $result = $this->countryCommand->serve($this->countryRequestMock, $this->countryServiceMock);

        $this->assertInstanceOf(ResponseContract::class, $result);
    }

    /**
     * testHandle.
     */
    public function testHandle()
    {
        $responseText = 'Dummy text for response';
        $this->countryCommand = $this->getMockBuilder(CountryCommand::class)->setMethods(['serve'])->getMock();
        $this->countryResponseMock->method('get')->will($this->returnValue($responseText));
        $this->countryCommand->expects($this->once())->method('serve')->willReturn($this->countryResponseMock);

        ob_start();
        $this->countryCommand->handle($this->countryRequestMock, $this->countryServiceMock);
        $result = ob_get_contents();
        ob_end_clean();

        $this->assertEquals($result, $responseText);
    }

    /**
     * testHandleError.
     */
    public function testHandleError()
    {
        $exceptionText = 'dummy exception text';
        $this->countryRequestMock->method('get')->will($this->returnValue([3 => 'Egypt']));
        $this->countryCommand = $this->getMockBuilder(CountryCommand::class)->setMethods(['serve'])->getMock();
        $this->countryCommand->expects($this->once())->method('serve')->will($this->throwException(new \Exception($exceptionText)));

        ob_start();
        $this->countryCommand->handle($this->countryRequestMock, $this->countryServiceMock);
        $result = ob_get_contents();
        ob_end_clean();

        $this->assertEquals($result, 'Error: ' . $exceptionText . "\n");
    }
}