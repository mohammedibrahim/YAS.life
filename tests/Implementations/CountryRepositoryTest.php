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

use YASLife\Contracts\APIsContract;
use YASLife\Contracts\CountryAPIsContract;
use YASLife\Implementations\CountryRepository;
use YASLifeTest\UnitTest;

/**
 * Country Repository Test
 *
 * Class Repository
 * @package YASLife\Implementations
 */
class CountryRepositoryTest extends UnitTest
{
    /**
     * repository.
     *
     * @var CountryRepository
     */
    protected $repository;

    /**
     * Value maps for getCountry.
     *
     * @var array
     */
    protected $getCountryValues = [
        ['Egypt',
            [
                [
                    'languages' => [
                        ['iso639_1' => 'ar']
                    ]
                ]
            ]
        ],
        ['Wrong country name', []],
    ];

    /**
     * Map Value for countries that speaks the same language .
     *
     * @var array
     */
    protected $countriesSpeakingLanguageValues = [
        [
            'ar',
            [
                ['name' => 'Egypt'],
                ['name' => 'Algeria'],
                ['name' => 'Saudi Arabia'],
                ['name' => 'Libya'],
                ['name' => 'Syria'],
            ]
        ],
        ['Wrong language code', []]
    ];

    /**
     * testGetByName.
     */
    public function testGetCountryCode()
    {
        $result = $this->repository->getCountryCode('Egypt');
        $this->assertEquals('ar', $result);
    }

    /**
     * testGetByName.
     */
    public function testGetCountryCodeNotFoundError()
    {
        $countryName = 'Wrong country name';
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage(sprintf('%s country not found!', $countryName));

        $this->repository->getCountryCode('Wrong country name');
     }

    /**
     * testGetByName.
     */
    public function testGetCountriesSpeakingSameLanguage()
    {
        $result = $this->repository->getCountriesSpeakingSameLanguage('ar', 'Egypt');

        $this->assertTrue(is_array($result));
        $this->assertEquals('["Algeria","Saudi Arabia","Libya","Syria"]', json_encode($result));
    }

    /**
     * testGetByName.
     */
    public function testGetCountriesSpeakingSameLanguageNotFoundError()
    {
        $wrongCountryName = 'Wrong country name';
        $wrongCountryCode = 'Wrong language code';

        $actual = $this->repository->getCountriesSpeakingSameLanguage($wrongCountryCode,$wrongCountryName);

        $this->assertTrue(empty($actual));
    }
     
    /**
     * Create Country Repository.
     */
    protected function setUp()
    {
        $this->repository = $this->createClassWithAbstractParams(CountryRepository::class, [APIsContract::class], [
            APIsContract::class => [
                'getCountry' => $this->returnValueMap($this->getCountryValues),
                'countriesSpeakLanguage' => $this->returnValueMap($this->countriesSpeakingLanguageValues),
            ]
        ]);
    }
}