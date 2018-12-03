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

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Response;
use YASLife\Implementations\CountryAPIs;
use YASLifeTest\UnitTest;

/**
 * Country APIs Test
 *
 * Class CountryAPIs
 * @package YASLife\Implementations
 */
class CountryAPIsTest extends UnitTest
{
    /**
     * APIs.
     *
     * @var CountryAPIs
     */
    protected $APIs;

    /**
     * apiResponseData.
     *
     * @var array
     */
    protected $apiResponseData;

    /**
     * test Get Country.
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testGetCountry()
    {
        $countryName = 'Egypt';
        $responseJson = '[1,2,3]';

        $response = $this->getMockBuilder(Response::class)->disableOriginalConstructor()->getMock();
        $response->method('getBody')->will($this->returnValue($responseJson));

        $this->apiResponseData = [
            ['GET', sprintf('name/Egypt?fullText=true'), [], $response],
        ];

        $this->mockAPIs();

        $result = $this->APIs->getCountry($countryName);

        $this->assertEquals($responseJson, json_encode($result));
    }

    /**
     * Mock APIs.
     *
     */
    public function mockAPIs()
    {
        $this->APIs = $this->createClassWithAbstractParams(CountryAPIs::class, [ClientInterface::class], [
            ClientInterface::class => [
                'request' => $this->returnValueMap($this->apiResponseData)
            ]
        ]);
    }

    /**
     * Test get country not found.
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testGetCountryNotFound()
    {
        $countryName = 'Egypt';
        $responseJson = false;

        $response = $this->getMockBuilder(Response::class)->disableOriginalConstructor()->getMock();
        $response->method('getBody')->will($this->returnValue($responseJson));

        $this->apiResponseData = [
            ['GET', sprintf('name/Egypt?fullText=true'), [], $response],
        ];

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage($countryName . ' country not found!');

        $this->mockAPIs();
        $this->APIs->getCountry($countryName);

    }

    /**
     * Asset result is equal to what is excepted.
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testCountriesSpeakLanguage()
    {
        $countryCode = 'ar';
        $responseJson = '[1,2,3]';

        $response = $this->getMockBuilder(Response::class)->disableOriginalConstructor()->getMock();
        $response->method('getBody')->will($this->returnValue($responseJson));

        $this->apiResponseData = [
            ['GET', sprintf('lang/ar'), [], $response],
        ];

        $this->mockAPIs();

        $result = $this->APIs->countriesSpeakLanguage($countryCode);

        $this->assertEquals($responseJson, json_encode($result));
    }

    /**
     * Must return an exception when json format is invalid
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testCountriesSpeakLanguageNotFound()
    {
        $languageCode = 'ar';
        $responseJson = false;
        $response = $this->getMockBuilder(Response::class)->disableOriginalConstructor()->getMock();
        $response->method('getBody')->will($this->returnValue($responseJson));
        $this->apiResponseData = [
            ['GET', sprintf('lang/ar'), [], $response],
        ];

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage(sprintf('Language code %s not found!', $languageCode));

        $this->mockAPIs();
        $this->APIs->countriesSpeakLanguage($languageCode);
    }
}