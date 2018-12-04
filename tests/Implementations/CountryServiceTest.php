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

use YASLife\Contracts\RequestContract;
use YASLife\Contracts\ResponseContract;
use YASLife\Implementations\CountryRepository;
use YASLife\Implementations\CountryService;
use YASLifeTest\UnitTest;

/**
 * Country Service
 *
 * Class CountryService
 * @package YASLife\Implementations
 */
class CountryServiceTest extends UnitTest
{
    /**
     * getCountryCodeResponse.
     *
     * @var array
     */
    protected $getCountryCodeResponse;

    /**
     * getCountriesSpeakingSameLanguageResponse.
     *
     * @var array
     */
    protected $getCountriesSpeakingSameLanguageResponse;

    /**
     * service class.
     *
     * @var
     */
    protected $service;

    /**
     * requestMock.
     *
     * @var RequestContract
     */
    protected $requestMock;

    /**
     * Test Get Country Name.
     */
    public function testGetCountryName()
    {
        $this->getCountryCodeResponse = [
            ['Egypt', 'ar'],
            ['Saudi Arabia', 'ar']
        ];

        $this->createRequestMock();

        $this->requestMock->method('get')->will($this->returnValue([
            1 => 'Egypt',
            2 => 'Saudi Arabia'
        ]));

        $this->requestMock->method('get')->will($this->returnValue([1 => 'Egypt']));

        $result = $this->service->getCountryName($this->requestMock);

        $this->assertInstanceOf(ResponseContract::class, $result);

        $this->assertEquals(sprintf('Country language code: ar%sEgypt speaks same language with these countries: Algeria, Saudi Arabia, Libya, Syria%s', PHP_EOL, PHP_EOL), $result->get());
    }

    /**
     * create Request Mock.
     */
    protected function createRequestMock()
    {
        $this->service = $this->createClassWithAbstractParams(CountryService::class, [
            CountryRepository::class,
        ], [
            CountryRepository::class => [
                'getCountryCode' => $this->returnValueMap($this->getCountryCodeResponse),
                'getCountriesSpeakingSameLanguage' => ['Algeria', 'Saudi Arabia', 'Libya', 'Syria'],
            ]
        ]);

        $this->requestMock = $this->getMockBuilder(RequestContract::class)->getMock();
    }

    /**
     * Test Check Taking Language Not Match.
     */
    public function testCheckTakingLanguageNotMatch()
    {
        $this->getCountryCodeResponse = [
            ['Egypt', 'ar'],
            ['Germany', 'de']
        ];

        $this->createRequestMock();

        $this->requestMock->method('get')->will($this->returnValue([
            1 => 'Egypt',
            2 => 'Germany'
        ]));

        $result = $this->service->checkTakingLanguage($this->requestMock);

        $this->assertInstanceOf(ResponseContract::class, $result);

        $this->assertEquals(sprintf('Egypt and Germany do not speak the same language.%s', PHP_EOL), $result->get());

    }

    /**
     * Test Check Taking Language Match.
     */
    public function testCheckTakingLanguageMatch()
    {
        $this->getCountryCodeResponse = [
            ['Egypt', 'ar'],
            ['Saudi Arabia', 'ar']
        ];

        $this->createRequestMock();

        $this->requestMock->method('get')->will($this->returnValue([
            1 => 'Egypt',
            2 => 'Saudi Arabia'
        ]));

        $result = $this->service->checkTakingLanguage($this->requestMock);

        $this->assertInstanceOf(ResponseContract::class, $result);

        $this->assertEquals(sprintf('Egypt and Saudi Arabia speak the same language.%s',PHP_EOL), $result->get());

    }
}