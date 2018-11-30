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
     * @throws \Exception
     */
    public function testGetCountry()
    {
        $countryName = 'Egypt';

        $this->apiResponseData = ['country' => 'Egypt'];

        $this->mockAPIs();

        $result = $this->APIs->getCountry($countryName);

        $this->assertEquals(json_encode($this->apiResponseData), json_encode($result));
    }

    /**
     * mockAPIs.
     */
    public function mockAPIs()
    {
        $this->APIs = $this->getMockBuilder(CountryAPIs::class)->setMethods(['request'])->getMock();

        $this->APIs->expects($this->once())->method('request')->willReturn(json_encode($this->apiResponseData));

    }

    /**
     * testGetCountryNotFound.
     *
     * @throws \Exception
     */
    public function testGetCountryNotFound()
    {
        $countryName = 'Egypt';
        $this->apiResponseData = 0;

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage($countryName . ' country not found!');

        $this->mockAPIs();
        $this->APIs->getCountry($countryName);


    }

    /**
     * testCountriesSpeakLanguage.
     *
     * @throws \Exception
     */
    public function testCountriesSpeakLanguage()
    {
        $countryCode = 'ar';

        $this->apiResponseData = ['code' => 'ar'];

        $this->mockAPIs();

        $result = $this->APIs->countriesSpeakLanguage($countryCode);

        $this->assertEquals(json_encode($this->apiResponseData), json_encode($result));
    }

    /**
     * testCountriesSpeakLanguageNotFound.
     *
     * @throws \Exception
     */
    public function testCountriesSpeakLanguageNotFound()
    {
        $countryCode = 'ar';
        $this->apiResponseData = 0;

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Something went wrong');

        $this->mockAPIs();
        $this->APIs->countriesSpeakLanguage($countryCode);


    }
}